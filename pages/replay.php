<?php
    if(isset($_GET['id']))
    {
        echo "Data for replay ID: " . $_GET['id'];
        echo "<a href='download.php?replay=" . $_GET['id'] . "'>Download</a>";
    }
    else
    {
        echo "<h2>Couldnt find replay id.";
    }
    

?>
