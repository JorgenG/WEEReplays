<div class="visiblediv" id="user">
    <?php 
        if(isset($_SESSION['valid_user'])) 
        {
            $userid = $_SESSION['valid_user'];
            echo "<p id='userinfo'><strong>Logged in as:</strong> $userid <a href='index.php?page=logout'>Logout</a></p>";
            echo "";
        } 
        else 
        {
            echo "
                <form name='login' method='post' action='index.php?page=login'>
                <p id='logintext'><strong>User: <input class='textinput' type='text' name='username'>
                Pass: <input class='textinput' type='password' name='password'></strong>  
                <input id='loginbutton' type='submit' value='Login' name='submit'></p>
                </form>";
        }
    ?>
</div>