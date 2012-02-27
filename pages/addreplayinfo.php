<?php
    if($_FILES["file"]["size"] < 150000
            && $_FILES["file"]["type"] == "application/octet-stream") 
    {
        if ($_FILES["file"]["error"] > 0) 
        {
            echo "Error: " . $_FILES["file"]["error"] . "<br />";
        } 
        else 
        {            
            $filesize = filesize($_FILES['file']['tmp_name']);
            $tempfile = fopen($_FILES["file"]["tmp_name"], 'r');
            $data = fread($tempfile, $filesize);
            fclose($tempfile); 
            
            $parsedData = parseUploadedReplay($data);
            echo"<h2>Upload successful</h2>";
        } 
    } 
    else 
    {
        echo "<p>Error with file</p>";
    }
    
    
    if(isset($_SESSION['valid_user'])) 
    {
        include('forms/addreplayinfoform.php');
    } 
    else 
    {
        echo "<h2>You must be logged in to upload replays.</h2>";
    }
?>
