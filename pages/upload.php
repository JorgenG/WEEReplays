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
            $title = $_POST['title'];
            $description = $_POST['description'];
            $factions = $_POST['factions'];
            $nrOfPlayers = $_POST['nrOfPlayers'];
            $map = $_POST['map'];
            $mode = $_POST['mode'];
            $gameversion = $_POST['gameversion'];
            
            $filesize = filesize($_FILES['file']['tmp_name']);
            $tempfile = fopen($_FILES["file"]["tmp_name"], 'r');
            $data = fread($tempfile, $filesize);
            fclose($tempfile); 
            
            addReplay($title, $gameversion, $description, $factions, $nrOfPlayers, $map, $mode, $data);
            echo"<h2>Upload successful</h2>";
        } 
    } 
    else 
    {
        echo "<p>Error with file</p>";
    }
?>
