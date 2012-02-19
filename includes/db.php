<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $dbname= 'weereplays';
    $dbusertable = 'Users';
    
    mysql_connect($dbhost, $dbuser, $dbpassword);
    mysql_select_db($dbname);          
?>
