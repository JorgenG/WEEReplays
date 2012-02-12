<div class="visiblediv" id="user">
    <?php 
        if(isset($_SESSION['valid_user'])) {
            $userid = $_SESSION['valid_user'];
            echo "<p>You are currently logged in as: $userid </p>";
            echo "<a href='index.php?page=logout'>Logout</a>";
        } else {
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
                                    <input type='text' size='12' maxlength='12' name='username'>
                                </td>
                            </tr>
                            <tr>
                                <td class='logincolumn'>
                                    <p>Password:</p>
                                </td>
                                <td class='logincolumn'>
                                    <input type='password' size='12' maxlength=12' name='password'>
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
                ";
        }
    ?>
</div>