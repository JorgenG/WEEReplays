<?php
    if(isset($_SESSION['valid_user'])) 
    {
        include('forms/addreplayform.php');
    } 
    else 
    {
        echo "<h1>You must be logged in to upload replays.</h1>";
    }
    
?>
