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
            
            $pivot = 132;
            
            for($i = 0; $i < $nrOfPlayersTeam1; $i++) 
            {
                $nextplayer = trim(substr($data, $pivot, 30));
                if(playerExist($nextplayer)) {
                    
                }
                $pivot = $pivot + 160;
            }
            for($i = 0; $i < $nrOfPlayersTeam2; $i++)
            {
                $nextplayer = trim(substr($data, $pivot, 30)) . ";";
                $pivot = $pivot + 160;
            }
        }
        
        $dateformat = "Y-m-d G:H:i";
        
        $query = "insert into Replays values('', '" . $mode . "', '" . $_SESSION['userid'] . 
                "', '" . $map . "', '" . $title . "', '" . $description . "', '" .
                $factionTeam1 . "', '" . $factionTeam2 . "', '" . $nrOfPlayersTeam1 . "', '" .
                $nrOfPlayersTeam2 . "', '" . $sqldata . "', '" . date($dateformat) . "')";
        mysql_query($query) or die(mysql_error());        
    }
    
    function playerExist($playername) {
        include('includes/db.php');
        
        $query = "select * from players";
        $result = mysql_query($query);
        
        if(mysql_num_rows($result) > 0) 
        {
            return true; 
        } 
        else 
        {
            return false;
        }          
    }
    
    function login($username, $password) 
    {
        include('includes/db.php');
        
        $query = "select * from " . $dbusertable . " where username = '" . trim($username) . "'";
        $result = mysql_query($query) or die(mysql_error());
        
        while($line = mysql_fetch_array($result)) 
        {
            if($line['password'] == md5($password)) 
            {
                $_SESSION['valid_user'] = $line['username'];
                $_SESSION['userid'] = $line['userId'];
                $_SESSION['access'] = $line['AccessLevels_accessLevel'];
            }
        }
    }
    
?>
