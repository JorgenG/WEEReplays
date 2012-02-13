<div id="navcontwrapper">                
    <?php include('includes/nav.php'); ?>                
    <div class='visiblediv' id='content'> 
        <?php 
            if(file_exists("pages/$page.php"))
            {
                include("pages/$page.php"); 
            } 
            else 
            {
                include("pages/error.php");
            }
        ?>
    </div>                
</div>            
<?php include('includes/user.php'); ?>