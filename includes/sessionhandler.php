<?php
    session_start();
    if($page == 'logout') {
        unset($_SESSION['valid_user']);
        session_destroy();
    } 
?>