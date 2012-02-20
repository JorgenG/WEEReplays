<?php
    
    class SessionHandler 
    {
        var $postData;
        var $page;
        var $sessionData;
        
        function SessionHandler($page, $postData, $sessionData)
        {
            session_start();
            
            $this->postData = $postData;
            $this->page = $page;
            $this->sessionData = $sessionData;
            
            setSessionState();
        }
        
        function setSessionState() 
        {
            if($page == "logout")
            {
                logout();
            }
            else if($page == "login")
            {
                $usernamePattern = "^[a-zA-Z][0-9a-zA-Z]{5-19}";
                if(preg_match($usernamePattern, $postData['username']))
                {
                    login($postData['username'], $postData['password']);
                }
            }
        }
        
        function login($username, $password)
        {
            include('includes/db.php');
            
            $query = "select * from " . $dbusertable . " where username = '" . $username . "'";
            $result = mysql_query($query) or die(mysql_error());

            $line = mysql_fetch_array($result);        
            if($line['upassword'] == md5($password)) 
            {
                $sessionData['username'] = $line['username'];
                $sessionData['userid'] = $line['userId'];
                $sessionData['access'] = $line['AccessLevels_accessLevel'];
            }   
        }
        
        function logout()
        {
            unset($sessionData['username']);
            unset($sessionData['userid']);
            unset($sessionData['access']);
            session_destroy();
        }
        
        function isValidUser($requiredAccessLevel = 0) 
        {
            if(isset($sessionData['username']) && $sessionData['access'] > $requiredAccessLevel)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        function getUserId()
        {
            return $sessionData['userid'];
        }
    }
    
?>
