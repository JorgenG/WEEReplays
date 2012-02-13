<?php
    session_start();
    if($page == 'logout') 
    {
        unset($_SESSION['valid_user']);
        unset($_SESSION['userid']);
        unset($_SESSION['access']);
        session_destroy();
    } 
?>