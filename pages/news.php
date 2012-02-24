<?php

    $result = getFrontpageNews();

    while($line = mysql_fetch_array($result))
        {
            $commentData = "<div class='pagecontentbox'>
                            <table class='newstable'>
                                <tr>
                                    <td class='postedbyheader'>
                                        <p class='newsheader'>
                                            Posted by ". $line['username'] .
                                        "</p>
                                    </td>
                                    <td class='dateheader'>
                                         ". $line['date'] ."
                                    </td>
                                </tr>
                                <tr>
                                    <td class='news' colspan='2'>
                                        <p class='newstext'>" .
                                            nl2br($line['ingress'])
                                        . "</p>
                                    </td>
                                </tr>
                            </table>
                        </div>";
            echo $commentData;
        }     

?>
