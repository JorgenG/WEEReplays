<?php

    echo "  <div class='pagecontentbox' id='addcomment'>
                        <form action='index.php?page=replay&id=". $_GET['id'] ."' method=post enctype='multipart/form-data'>
                            <table>
                                <tr>
                                    <td valign='top'><p class='commentheader'>Comment:</p></td>
                                    <td><textarea name='comment' rows='5' cols='40'></textarea></td>
                                </tr>
                                <tr>
                                    <td><input type='submit' name='submit' value='Add comment' /></td>
                                </tr>
                            </table>
                        </form>
            </div>";
?>
