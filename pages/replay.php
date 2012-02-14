<?php
    if(isset($_POST['id']))
    {
        echo "Data for replay ID: " . $_POST['id'];
    }
    else
    {
        echo "<h2>Couldnt find replay id.";
    }
    

?>
