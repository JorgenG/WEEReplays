<?php

    function userNameTaken($username) 
    {
        include('includes/db.php');
        
        $query = "select * from " . $dbusertable . " where username = '" . trim($username) . "'";
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
        
        $query = "select * from " . $dbusertable . " where email = '" . trim($email) . "'";
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
        
        $query = "insert into " . $dbusertable . " values('', '5', '" . $username . "', '" . $email . "', '" . md5($password) . "')";
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
        
        $sqldata = addslashes($data);
        
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
                "', '" . $map . "', '" . $title . "', '" . $description . "', '" .
                $factionTeam1 . "', '" . $factionTeam2 . "', '" . $nrOfPlayersTeam1 . "', '" .
                $nrOfPlayersTeam2 . "', '" . $sqldata . "', '" . date($dateformat) . "', '0')";
        mysql_query($query) or die(mysql_error());   
        $replayid = mysql_insert_id();
                
        if($nrOfPlayers != "Other")
        {            
            $pivot = 132;            
            for($i = 0; $i < $nrOfPlayersTeam1; $i++) 
            {
                $nextplayer = trim(substr($data, $pivot, 30));
                addPlayerToReplay($nextplayer, $replayid, $factionTeam1);
                $pivot = $pivot + 160;
            }
            for($i = 0; $i < $nrOfPlayersTeam2; $i++)
            {
                $nextplayer = trim(substr($data, $pivot, 30));
                addPlayerToReplay($nextplayer, $replayid, $factionTeam2);
                $pivot = $pivot + 160;
            }
        }  
    }
    
    function addPlayerToReplay($playername, $replayid, $faction) {
        include('includes/db.php');
        
        $query = "select * from players where playerName = '" . $playername . "'";
        $result = mysql_query($query);
        
        if(mysql_num_rows($result) > 0) 
        {
            $row = mysql_fetch_array($result);
            $playerid = $row['playerId'];
        } 
        else 
        {
            mysql_query("insert into players values ('', '" . $playername . "')") or die(mysql_error());
            $playerid = mysql_insert_id();
        }  
        mysql_query("insert into players_has_replays values('" . $playerid . "', '" .
                $replayid . "', '" . $faction . "')") or die(mysql_error());
    }
    
    function login($username, $password) 
    {
        include('includes/db.php');
        
        $query = "select * from " . $dbusertable . " where username = '" . trim($username) . "'";
        $result = mysql_query($query) or die(mysql_error());
        
        while($line = mysql_fetch_array($result)) 
        {
            if($line['upassword'] == md5($password)) 
            {
                $_SESSION['valid_user'] = $line['username'];
                $_SESSION['userid'] = $line['userId'];
                $_SESSION['access'] = $line['AccessLevels_accessLevel'];
            }
        }
    }
    
    function getReplayData() 
    {
        
    }
    
    function echoReplayData($replayid) 
    {
        include('includes/db.php');
        
        $query = "select replayData from Replays where replayId = '" . $replayid . "'";
        $result = mysql_query($query);
        
        if(mysql_num_rows($result) == 1) 
        {
            $line = mysql_fetch_array($result);
            echo $line['replayData'];
            
            $query = "update Replays SET downloadCounter = downloadCounter + 1 where replayId = '" . $replayid . "'";
            mysql_query($query);
        }
    }
    
    function getReplaysPage($fromentry) 
    {
        include('includes/db.php');
        
        $lowlimit = $fromentry;
        $maxlimit = $fromentry + 20;
        
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
                    uploadDate
                from 
                    Replays, 
                    Users, 
                    GameModes, 
                    Maps
                where
                    Users_userId = userId AND
                    GameModes_gameModeId = gameModeId AND
                    Maps_mapId = mapId
                order by
                    uploadDate desc
                limit
                    " . $lowlimit . ", " . $maxlimit;
        
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
    
?>
