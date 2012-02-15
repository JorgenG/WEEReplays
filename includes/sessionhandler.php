<?php
    session_start();
    if($page == 'logout') 
    {
        unset($_SESSION['valid_user']);
        unset($_SESSION['userid']);
        unset($_SESSION['access']);
        session_destroy();
    } 
    
    if($page == 'login' && isset($_POST['username'])) 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        login($username, $password);       
    }
?>