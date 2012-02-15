<div id="navcontwrapper">                
    <?php include('includes/nav.php'); ?>
    <?php include('includes/user.php'); ?>
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
