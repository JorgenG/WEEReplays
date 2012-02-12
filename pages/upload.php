<?php

    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
    } else {
        //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        //echo "Type: " . $_FILES["file"]["type"] . "<br />";
        //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        //echo "Stored in: " . $_FILES["file"]["tmp_name"];
        
        $file_name = "2145.wargamerpl";
        $filesize = filesize($_FILES['file']['tmp_name']);

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: Attachment; filename=$file_name");
        header("Content-Length: $filesize");

        // $my_data is the string that holds your data
        $tempfile = fopen($_FILES["file"]["tmp_name"], 'r');
       
        echo fread($tempfile, $filesize);
        
        fclose($tempfile);     
        
    }  
    
    header("index.php?page=home");
    exit();
?>
