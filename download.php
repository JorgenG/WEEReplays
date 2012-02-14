<?php
    include('includes/functions.php');

    if(isset($_GET['replay']))
    {
        $replayid = $_GET['replay'];
        $filename = $replayid . ".wargamerpl";
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: Attachment; filename=$filename");
        echoReplayData($replayid);
        exit();
    }
    else
    {
        echo "<h2>Couldnt find replay id.";
    }

    
?>
