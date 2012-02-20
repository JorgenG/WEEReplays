<?php
    $changePasswordForm = "
        <h2>Configure user settings</h2>
        <div class='pagecontentbox'>
        <form action='index.php?page=user' method=post enctype='multipart/form-data'>
            <table class='changepasstable'>

                <tr>
                    <td class='formlabel' align='right'>
                        <label for='title'>Old password:</label>
                    </td>
                    <td class='forminput'>
                        <input size='20' type='password' name='oldpassword' />
                    </td>
                </tr>
                <tr>
                    <td class='formlabel' align='right'>
                        <label for='information'>New password:</label>
                    </td>
                    <td class='forminput'>
                        <input size='20' type='password' name='newpassword' />
                    </td>
                </tr>
                <tr>
                    <td class='formlabel' align='right'>
                        <label for='file'>Confirm new password:</label>
                    </td>
                    <td class='forminput'>
                        <input size='20' type='password' name='newpasswordconfirm'/>
                    </td>
                </tr>
                <tr>
                    <td colspan='2' align='right'>
                        <input type='submit' value='Change password'/>" ;
    if(isset($message)) 
    {
        $changePasswordForm .= $message;
    }
        $changePasswordForm .= "</td>
                </tr>
            </table>
        </form></div>        ";
    echo $changePasswordForm;
?>
