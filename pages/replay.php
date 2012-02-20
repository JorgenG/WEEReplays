<?php
    if(isset($_GET['id']))
    {        
        if(isset($_POST['rating'])) 
        {
            if(isset($_SESSION['valid_user']))
            {
                addRatingForReplay($_GET['id'], $_POST['rating'], $_SESSION['userid']);
            }
        }
        
        if(isset($_POST['comment']))
        {
            if(isset($_SESSION['valid_user']))
            {
                addCommentForReplay($_GET['id'], $_POST['comment']);
            }
        }
        
        $result = getReplayData($_GET['id']);        
        $data = mysql_fetch_array($result);
        
        $_SESSION['dlticket'] = $_GET['id'];
        
        $playersTeam1 = getPlayersOnTeam($_GET['id'], 1);
        $playersTeam2 = getPlayersOnTeam($_GET['id'], 2);
        
        $pageData = "<h2>Replay information for replay ID: " . $data['replayId'] . 
                "</h2>
                <div class='pagecontentbox' id='replayinfo'>
                <table class='replaydatatable'>
                    <tr>
                        <th width='150'>
                        </th>
                        <th colspan='2' width='600'>
                        </th>
                    </tr>
                    <tr>
                        <td class='replayheadercell'>
                            <p class='replayheader'>Title:</p>
                        </td>
                        <td colspan='2' class='replaycolumncell'><p class='replaytext'>";
        $pageData .= $data['title'];
                        
        $pageData .= "</p></td>
                    </tr>
                    <tr>
                        <td>
                        <p class='replayheader'>Description:</p>
                        </td>
                        <td colspan='2' height='70'><p class='replaytext'>";
        $pageData .= nl2br($data['description']);
        
        $pageData .= "</p></td>
                    </tr>
                    <tr>
                        <td>
                        <p class='replayheader'>Uploaded by:</p>
                        </td>
                        <td><p class='replaytext'>";
        $pageData .= $data['username'];
        
        $pageData .= "</p></td>
                    </tr>
                    <tr>
                        <td>
                        <p class='replayheader'>Players:</p>
                        </td>
                        <td width='250'><p class='replayfaction'>";
        if($data['factionTeam1'] == "NATO") 
        {
            $pageData .= "<p id='NATO'>NATO</p>";
        } 
        else
        {
            $pageData .= "<p id='PACT'>PACT</p>";
        }
        $pageData .= "</p>";
        while($player = mysql_fetch_array($playersTeam1))
        {
            $pageData .= "<p class='replayplayer'>" . $player['playername'] .
                "</p>";
        }
        $pageData .= "</td><td width='250'><p class='replayFaction'>";
        if($data['factionTeam2'] == "NATO") 
        {
            $pageData .= "<p id='NATO'>NATO</p>";
        } 
        else
        {
            $pageData .= "<p id='PACT'>PACT</p>";
        }
        $pageData .= "</p>";
        while($player = mysql_fetch_array($playersTeam2))
        {
            $pageData .= "<p class='replayplayer'>" . $player['playername'] .
                "</p>";
        }
        $pageData .= "</td></tr>
                <tr class='tabledatarow'>
                    <td><p class='replayheader'>Map:";
        
        $pageData .= "</p></td>
                <td colspan='2'><p class='replaytext'>";
        $pageData .= $data['mapName'];
        $pageData .= "</td>
                <tr class='tabledatarow'>
                    <td><p class='replayheader'>Mode:</p></td>
                    <td colspan='2'><p class='replaytext'>";
        $pageData .= $data['gameModeName'];
        $pageData .= "</p></td>
                <tr class='tabledatarow'>
                    <td><p class='replayheader'># of Downloads:</p></td>
                    <td colspan='2'><p class='replaytext'>";
        $pageData .= $data['downloadCounter'];
        $pageData .= "</p></td>
                <tr class='tabledatarow'>
                    <td><p class='replayheader'>Download:</p></td>
                    <td><a href='download.php?replay=" . $_GET['id'] . "'>Download</a></td>";
        if(isset($_SESSION['valid_user']) && !userVotedBefore($_GET['id'], $_SESSION['userid']))
        {
            $pageData .= "<td>
                        <form action='index.php?page=replay&id=" . $_GET['id'] . 
                            "' method=post enctype='multipart/form-data'>
                            <select name='rating'>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>                                
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                            </select>
                            <input type='submit' value='Rate'/>
                        </form>
                        </td>";
        } 
        else
        {
            $pageData .= "<td><p>Log in to rate replays!</p></td>";
        }
        $pageData .=   "</tr>
                        </table></div><h2>Add comment</h2>";
        
        echo $pageData;
        
        if(isset($_SESSION['valid_user'])) 
        {
            include('forms/addcommentform.php');
        }
        else
        {
            echo "  
                    <div class='pagecontentbox'>                        
                            <table>
                                <tr>
                                    <td>You must be logged in to add a comment.</td>
                                </tr>
                            </table>
                    </div>";
        }
        echo "<h2>Comments</h2>";
        
        $result = getCommentsForReplay($_GET['id']);
        
        while($line = mysql_fetch_array($result))
        {
            $commentData = "<div class='pagecontentbox'>
                            <table class='commenttable'>
                                <tr>
                                    <td class='commentheader'>
                                        <p class='commentheader'>
                                            Posted by ". $line['username'] .", ". $line['date'] .
                                        "</p>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr class='commentlabel'>
                                    <td class='commentdescription' colspan='2'>
                                        <p class='commenttext'>" .
                                            nl2br($line['comment'])
                                        . "</p>
                                    </td>
                                </tr>
                            </table>
                        </div>";
            echo $commentData;
        }        
        
        
    }
    else
    {
        echo "<h2>Couldnt find replay id.";
    }
    

?>
