<?php
    if(isset($_SESSION['valid_user'])) {
        echo "  <form action='pages\upload.php' method=post enctype='multipart/form-data'>
                <label for='file'>Filename:</label>
                <input type='file' name='file' id='file' /><br />
                <input type='submit' name='submit' value='Submit' />
            </form>";
    } else {
        echo "You must be logged in to upload replays.";
    }
    
?>
