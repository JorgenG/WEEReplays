<!DOCTYPE html>
<?php 
    include('includes/sessionhandler.php');
    if(!empty($_GET["page"])) {
            $page = $_GET["page"];
    } else {
            $page = "home";
    }	
?>
<html>
    
    <head>
        <link rel="stylesheet" type="text/css" href="weereplays.css">
        <meta charset="utf-8">
        <title>RPG - Play by post</title>
    </head>
    <body>
        <div id='wrapper'>
            <?php include('includes/header.php'); ?>
            <?php include('includes/content.php'); ?>            
            <?php include('includes/footer.php'); ?>				
        </div>
    </body>
</html>