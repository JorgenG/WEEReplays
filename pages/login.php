<?php

if (isset($_SESSION['valid_user'])) 
{
    echo "<h3>You are already logged in!</h3>";
} 
else 
{
    if(isset($_SESSION['valid_user'])) 
    {
        echo "<h3>Successfully logged in</h3>";   
        echo "Access level is: " . $_SESSION['access'];
    } 
    else 
    {
        echo "<h3>Could not login. Are you sure username and/or password is correct?</h3>";
    }    
}
?>