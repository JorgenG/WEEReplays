<?php       
    if(isset($_GET['page'])) 
    {
            $page = $_GET['page'];
    } 
    else 
    {
            $page = "home";
    }	
    include('includes/constants.php');
    include('includes/functions.php'); 
    include('includes/sessionhandler.php'); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    
    <head>
        <link rel="stylesheet" type="text/css" href="weereplays.css?version=1">
        <link REL="SHORTCUT ICON" HREF="favicon.ico">
        <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Wargame: European Escalation replays</title>
    </head>
    <body>
        <div id='wrapper'>
            <?php 
                include('includes/header.php'); 
                include('includes/content.php');           
                include('includes/footer.php'); 
            ?>				
        </div>
    </body>
</html>