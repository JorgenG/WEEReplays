<?php

    if(isset($_SESSION['valid_user'])) 
    {
        echo "<h3>Successfully logged in</h3>";   
        echo "Access level is: " . $_SESSION['access'];
    } 
    else 
    {
        echo "<h3>Could not login</h3>
            <p>Are you sure username and/or password is correct?</p>";
    }    

?>