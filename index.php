<!DOCTYPE html>
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
    include('includes/db.php');    
?>
<html>
    
    <head>
        <link rel="stylesheet" type="text/css" href="weereplays.css">
        <link REL="SHORTCUT ICON" HREF="favicon.ico">
        <meta charset="utf-8">
        <title>W:EE Replays - Your storage for sharing and storing W:EE replays</title>
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