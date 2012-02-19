<?php

    function userNameTaken($username) 
    {
        include('includes/db.php');
        
        $query = "select * from " . $dbusertable . " where username = '" . mysql_real_escape_string(trim($username)) . "'";
        $result = mysql_query($query) or die(mysql_error());
        
        if(mysql_num_rows($result) > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }        
    }
    
    function emailAlreadyRegistered($email) 
    {
        include('includes/db.php');
        
        $query = "select * from " . $dbusertable . " where email = '" . mysql_real_escape_string(trim($email)) . "'";
        $result = mysql_query($query) or die(mysql_error());
        
        if(mysql_num_rows($result) > 0) 
        {
            return true; 
        } 
        else 
        {
            return false;
        }        
    }
    
    function addNewUser($username, $email, $password) 
    {
        include('includes/db.php');
        
        $query = "insert into " . $dbusertable . " values('', '5', '" . mysql_real_escape_string(trim($username)) . "', '" . mysql_real_escape_string(trim($email)) . "', '" . md5($password) . "')";
        $result = mysql_query($query) or die(mysql_error());
    }
    
    function getMaps() 
    {
        include('includes/db.php');
        
        $query = "select * from Maps";
        $maps = mysql_query($query) or die(mysql_error());
        
        return $maps;
    }
    
    function getModes()
    {
        include('includes/db.php');
        
        $query = "select * from GameModes";
        $modes = mysql_query($query) or die(mysql_error());
        
        return $modes;
    }
    
    function addReplay($title, $description, $factions, $nrOfPlayers, $map, $mode, $data) 
    {
        include('includes/db.php');
        
        $sqldata = mysql_real_escape_string($data);
        
        if(substr($factions, 0, 1) == 'n') 
        {
            $factionTeam1 = "NATO";
        } 
        else 
        {
            $factionTeam1 = "PACT";
        }
        
        if(substr($factions, 2, 1) == 'n')
        {
            $factionTeam2 = "NATO";
        }
        else
        {
            $factionTeam2 = "PACT";
        }       
        
        if($nrOfPlayers != "Other")
        {
            $nrOfPlayersTeam1 = intval(substr($nrOfPlayers, 0, 1));
            $nrOfPlayersTeam2 = intval(substr($nrOfPlayers, 2, 1));
        }
        else 
        {
            $nrOfPlayersTeam1 = -1;
            $nrOfPlayersTeam2 = -1;
        }
        
        $dateformat = "Y-m-d H:i:s";
        
        $query = "insert into Replays values('', '" . $mode . "', '" . $_SESSION['userid'] . 
                "', '" . $map . "', '" . mysql_real_escape_string($title) . "', '" . mysql_real_escape_string($description) . "', '" .
                $factionTeam1 . "', '" . $factionTeam2 . "', '" . $nrOfPlayersTeam1 . "', '" .
                $nrOfPlayersTeam2 . "', '" . $sqldata . "', '" . date($dateformat) . "', '0', '0')";
        mysql_query($query) or die(mysql_error());   
        $replayid = mysql_insert_id();
                
        if($nrOfPlayers != "Other")
        {            
            $pivot = 132;            
            for($i = 0; $i < $nrOfPlayersTeam1; $i++) 
            {
                $nextplayer = trim(substr($data, $pivot, 30));
                addPlayerToReplay($nextplayer, $replayid, 1);
                $pivot = $pivot + 160;
            }
            for($i = 0; $i < $nrOfPlayersTeam2; $i++)
            {
                $nextplayer = trim(substr($data, $pivot, 30));
                addPlayerToReplay($nextplayer, $replayid, 2);
                $pivot = $pivot + 160;
            }
        }  
    }
    
    function addPlayerToReplay($playername, $replayid, $teamNumber) {
        include('includes/db.php');
        
        $query = "select * from Players where playerName = '" . mysql_real_escape_string($playername) . "'";
        $result = mysql_query($query);
        
        if(mysql_num_rows($result) > 0) 
        {
            $row = mysql_fetch_array($result);
            $playerid = $row['playerId'];
        } 
        else 
        {
            mysql_query("insert into Players values ('', '" . mysql_real_escape_string($playername) . "')") or die(mysql_error());
            $playerid = mysql_insert_id();
        }  
        mysql_query("insert into Players_has_Replays values('" . mysql_real_escape_string($playerid) . "', '" .
                $replayid . "', '" . $teamNumber . "')") or die(mysql_error());
    }
    
    function login($username, $password) 
    {
        include('includes/db.php');
        
        $query = "select * from " . $dbusertable . " where username = '" . mysql_real_escape_string(trim($username)) . "'";
        $result = mysql_query($query) or die(mysql_error());
        
        $line = mysql_fetch_array($result);        
        if($line['upassword'] == md5($password)) 
        {
            $_SESSION['valid_user'] = $line['username'];
            $_SESSION['userid'] = $line['userId'];
            $_SESSION['access'] = $line['AccessLevels_accessLevel'];
        }        
    }
    
    function getReplayData($replayId) 
    {
        include('includes/db.php');
        
        $query = "select 
                    replayId, 
                    gameModeName, 
                    mapName, 
                    username,  
                    title,
                    description,
                    factionTeam1,
                    factionTeam2,
                    uploadDate,
                    downloadCounter
                from 
                    Replays, 
                    Users, 
                    GameModes, 
                    Maps
                where
                    Users_userId = userId AND
                    GameModes_gameModeId = gameModeId AND
                    Maps_mapId = mapId AND
                    replayId = " . mysql_real_escape_string($replayId);
        $result = mysql_query($query) or die(mysql_error());
        return $result;        
    }
    
    function addRatingForReplay($replayId, $rating, $userId)
    {
        include('includes/db.php');
        
        if(!userVotedBefore($replayId, $userId)) 
        {
            
            $query = "insert into Ratings values ('', '" . $userId . "', '" . mysql_real_escape_string($replayId) . "', '" . mysql_real_escape_string($rating) . "')"; 
            mysql_query($query) or die(mysql_error());
        }
    }
    
    function userVotedBefore($replayId, $userId)
    {
        include('includes/db.php');
        
        $query = "select * from Ratings where Users_userId = '" . $userId . "' AND Replays_replayId = '" . mysql_real_escape_string($replayId) . "'";
        $result = mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($result) == 0) 
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    function getPlayersOnTeam($replayId, $teamNumber) {
        include('includes/db.php');
        $query = "select
                    playername
                  from
                    Players,
                    Players_has_Replays
                  where
                    Players.playerId = Players_has_Replays.Players_playerId AND
                    Players_has_Replays.playerTeam = ". $teamNumber .
                    " AND Players_has_Replays.Replays_replayId = " . $replayId;
        $result = mysql_query($query) or die(mysql_error());
        return $result;
    }
    
    function echoReplayData($replayid) 
    {
        include('includes/db.php');
        
        $query = "select replayData from Replays where replayId = '" . mysql_real_escape_string($replayid) . "'";
        $result = mysql_query($query);
        
        if(mysql_num_rows($result) == 1) 
        {
            $line = mysql_fetch_array($result);
            echo $line['replayData'];
            
            $query = "update Replays SET downloadCounter = downloadCounter + 1 where replayId = '" . mysql_real_escape_string($replayid) . "'";
            mysql_query($query);
        }
    }
    
    function getReplaysPage($fromentry) 
    {
        include('includes/constants.php');
        include('includes/db.php');
        
        $query = "select 
                    replayId, 
                    gameModeName, 
                    mapName, 
                    username,  
                    title,
                    factionTeam1,
                    factionTeam2,
                    nrOfPlayersTeam1,
                    nrOfPlayersTeam2,
                    uploadDate,
                    downloadCounter,
                    AVG(rating) as average,
                    COUNT(ratingId) as ratings
                from 
                    Replays left join Ratings on Replays_replayId = replayId, 
                    Users, 
                    GameModes, 
                    Maps
                where
                    Replays.Users_userId = Users.userId AND
                    GameModes_gameModeId = gameModeId AND
                    Maps_mapId = mapId AND
                    isDeleted = 0
                group by
                    replayId
                order by
                    uploadDate desc
                limit
                    " . mysql_real_escape_string($fromentry) . ", " . $replaysPrPage;
        
        $result = mysql_query($query) or die(mysql_error());
        return $result;
    }
    
    function countReplays()
    {
        $query = "select COUNT(*) as nrOfReplays from Replays";
        $result = mysql_query($query);
        
        $line = mysql_fetch_array($result);
        return $line['nrOfReplays'];        
    }
    
    function echoMenuItem($curPage, $displayName, $pageName, $notForLoggedInUsers)
    {
        
        if($curPage == $pageName)
        {
            if($notForLoggedInUsers && isset($_SESSION['valid_user'])){
                
            }
            else 
            {
                echo "<li><a id='current' href='index.php?page=".$pageName."'>".$displayName."</a></li>";
            } 
        }                            
        else
        {
            if($notForLoggedInUsers && isset($_SESSION['valid_user'])){
                
            }
            else 
            {
                echo "<li><a href='index.php?page=".$pageName."'>".$displayName."</a></li>";
            }                
        }
    }
    
    function echoMenuItemForUsersAboveLevel($curPage, $displayName, $pageName, $reqLevel) 
    {
        if(isset($_SESSION['access']) && $_SESSION['access'] >= $reqLevel)
        {
            if($curPage == $pageName)
            {
                echo "<li><a id='current' href='index.php?page=".$pageName."'>".$displayName."</a></li>";
            }                            
            else
            {
                echo "<li><a href='index.php?page=".$pageName."'>".$displayName."</a></li>";
            }
        }
    }
    
    function echoMenuItemForUsersBelowLevel($curPage, $displayName, $pageName, $maxLevel) 
    {
        if(isset($_SESSION['access']) && $_SESSION['access'] <= $maxLevel)
        {
            if($curPage == $pageName)
            {
                echo "<li><a id='current' href='index.php?page=".$pageName."'>".$displayName."</a></li>";
            }                            
            else
            {
                echo "<li><a href='index.php?page=".$pageName."'>".$displayName."</a></li>";
            }
        }
    }
    
    function updatePassword($oldpassword, $newpassword, $newpasswordconfirm) 
    {
        include('includes/db.php');
        if($newpassword == $newpasswordconfirm && strlen($newpassword) > 5 && strlen($newpassword) < 21)
        {
            $query = "select * from " . $dbusertable . " where userId = '" . $_SESSION['userid'] . "'";
            $result = mysql_query($query) or die(mysql_error());

            $line = mysql_fetch_array($result);        
            if($line['upassword'] == md5($oldpassword)) 
            {
                $query = "update " . $dbusertable . " set upassword = '" . md5($newpassword) . 
                        "' where userId = '" . $_SESSION['userid'] . "'";
                mysql_query($query) or die(mysql_error());
                return true;
            } 
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    function addCommentForReplay($replayId, $comment) 
    {
        include('includes/db.php');
        $dateformat = "Y-m-d H:i:s";
        $query = "insert into Comments VALUES ('', '" . mysql_real_escape_string($_SESSION['userid']) . "', '" . 
                mysql_real_escape_string($replayId) . "', '" . mysql_real_escape_string($comment) . "', '" . 
                date($dateformat) ."')";
        mysql_query($query) or die(mysql_error());
    }
    
    function getCommentsForReplay($replayId)
    {
        include('includes/db.php');
        
        $query = "select username, comment, date from Comments LEFT JOIN Users ON Users_userId = userId WHERE Replays_replayId = '" . 
                mysql_real_escape_string($replayId) . "'";
        $result = mysql_query($query) or die(mysql_error());
        return $result;
    }
    
?>
