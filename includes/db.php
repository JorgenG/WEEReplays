<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $dbname= 'weereplays';
    $dbusertable = 'users';
    
    mysql_connect($dbhost, $dbuser, $dbpassword);
    mysql_select_db($dbname);          
?>
