<?php   
    global $error;
    echo "  <h2>Register new user:</h2>
            <form name='register' method='post' action='index.php?page=register'>
                <table class='registertable'>
                    <tr>
                        <td colspan='3'>
                            <h3>Enter your information</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class='formlabel'>
                            <p>Username:</p>
                        </td>
                        <td class='forminput'>
                            <input class='registerforminput' type='text' name='regusername'>
                        </td>
                        <td>";

    if(isset($error['username'])) {
        echo "<p class='loginerror'>" . $error['username'] . "</p>";
    } 
    echo                "</td>
                    </tr>
                    <tr>
                        <td class='formlabel'>
                            <p>E-mail:</p>
                        </td>
                        <td class='forminput'>
                            <input class='registerforminput' type='text' name='regemail'>
                        </td>
                        <td>";
    if(isset($error['email'])) {
        echo "<p class='loginerror'>" . $error['email'] . "</p>";
    } 
    echo                "</td>
                    </tr>
                    <tr>
                        <td class='formlabel'>
                            <p>Password:</p>
                        </td>
                        <td class='forminput'>
                            <input class='registerforminput' type='password' name='regpassword'>
                        </td>
                        <td>";
    if(isset($error['password'])) {
        echo "<p class='loginerror'>" . $error['password'] . "</p>";
    } 
    echo                "</td>
                    </tr>
                    <tr>
                        <td class='formlabel'>
                            <p>Confirm password:</p>
                        </td>
                        <td class='forminput'>
                            <input class='registerforminput' type='password' name='regpasswordconfirm'>
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td align='right'>
                            <input type='submit' value='Register' name='regsubmit'>
                        </td>
                        <td>

                        </td>
                    </tr>
                </table>
            </form>";
?>
