<?php
    session_start();
    include('includes/functions.php');

    if(isset($_GET['replay']))
    {
        if(isset($_SESSION['dlticket']) && $_SESSION['dlticket'] == $_GET['replay'])
        {
            unset($_SESSION['dlticket']);
            $replayid = $_GET['replay'];
            $filename = $replayid . ".wargamerpl";
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: Attachment; filename=$filename");
            echoReplayData($replayid);
            exit();
        } 
        else
        {
            echo "<h2>You cannot use a direct link to download this</h2>
                <p><a href='index.php?page=replay&id=". $_GET['replay'] . "'>Click here</a> to enter the correct page.";
        }
    }
    else
    {
        echo "<h2>Couldnt find replay id.";
    }

    
?>
