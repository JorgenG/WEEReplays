<?php

    $result = getFrontpageNews();

    while($line = mysql_fetch_array($result))
        {
            $newspost = "<h2>". $line['title'] . "</h2>
                        <div class='pagecontentbox'>
                            <table class='newstable'>
                            <tr>
                                    <td class='news' colspan='2'>
                                        <p class='newstext'>" .
                                            nl2br($line['ingress'])
                                        . "</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class='postedbyheader'>
                                            
                                        </p>
                                    </td>
                                    <td><p class='dateheader'>
                                         Posted by ". $line['username'] . " on " . $line['date'] ."</p>
                                    </td>
                                </tr>
                                
                            </table>
                        </div>";
            echo $newspost;
        }     

?>
