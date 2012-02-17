<?php
    if(isset($_SESSION['valid_user'])) 
    {
        if(isset($_POST['oldpassword']) && 
            isset($_POST['newpassword']) && 
            isset($_POST['newpasswordconfirm']))
        {
            if(updatePassword($_POST['oldpassword'], $_POST['newpassword'], $_POST['newpasswordconfirm']))
            {
                $message = "<p>Password updated successfully!</p>";
            }
            else
            {
                $message = "<p>Password change did not work. Is your old password correct ".
                    "and the new password between 6 and 20 characters?</p>";
            }
        }
        include('forms/userform.php');
    }
    else 
    {
        echo "<h2>You must be logged in to access the user control panel.</h2>";
    }

?>
