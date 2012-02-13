<div class="visiblediv" id="user">
    <?php 
        if(isset($_SESSION['valid_user'])) 
        {
            $userid = $_SESSION['valid_user'];
            echo "<p>You are currently logged in as: $userid </p>";
            echo "<a href='index.php?page=logout'>Logout</a>";
        } 
        else 
        {
            echo "  <form name='login' method='post' action='index.php?page=login'>
                        <table class='logintable'>
                            <tr>
                                <td colspan='2'>
                                    <h3>Login below</h3>
                                </td>
                            </tr>
                            <tr>
                                <td class='logincolumn'>
                                    <p>Username:</p>
                                </td>
                                <td class='logincolumn'>
                                    <input class='textinput' type='text' name='username'>
                                </td>
                            </tr>
                            <tr>
                                <td class='logincolumn'>
                                    <p>Password:</p>
                                </td>
                                <td class='logincolumn'>
                                    <input class='textinput' type='password' name='password'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    
                                </td>
                                <td align='right'>
                                    <input type='submit' value='Login' name='submit'>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <p>If you dont have an account, <a href='index.php?page=register'>click here</a> to register.</p>
                ";
        }
    ?>
</div>