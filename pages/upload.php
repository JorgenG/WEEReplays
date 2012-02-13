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
            
            $filesize = filesize($_FILES['file']['tmp_name']);
            $tempfile = fopen($_FILES["file"]["tmp_name"], 'r');
            $data = fread($tempfile, $filesize);
            fclose($tempfile); 
            
            addReplay($title, $description, $factions, $nrOfPlayers, $map, $mode, $data);
            
            
            
            
                
            
            //$file_name = "2145.wargamerpl";
            

            //header("Content-Type: application/octet-stream");
            //header("Content-Disposition: Attachment; filename=$file_name");
            //header("Content-Length: $filesize");

            // $my_data is the string that holds your data
            

            
            

            //$query = "INSERT INTO replays VALUES ('', 'TITLE', 'DESCRIPTION','" . $_SESSION['userid'] . "', '". $data ."', 'nvp', '3v3', 'BrokenTomato;Diana;Tom:Turbo;Kano;Bano', '2012-02-13 14:52:20', 'MAPNAME', 'DESTRUCTION//TIME - MODE')";
            //mysql_query($query) or die(mysql_error());
            //echo fread($tempfile, $filesize);

                            
        } 
    } 
    else 
    {
        echo "<p>Error with file</p>";
    }
?>
