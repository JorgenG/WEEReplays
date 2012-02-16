<?php
    if(isset($_GET['id']))
    {        
        $result = getReplayData($_GET['id']);        
        $data = mysql_fetch_array($result);
        
        $playersTeam1 = getPlayersOnTeam($_GET['id'], 1);
        $playersTeam2 = getPlayersOnTeam($_GET['id'], 2);
        
        $pageData = "<h2>Replay information for replay ID: " . $data['replayId'] . 
                "</h2><table class='replaydatatable'>
                    <tr>
                        <th width='150'>
                        </th>
                        <th colspan='2' width='500'>
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
        $pageData .= $data['description'];
        
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
                    <td colspan='2'><a href='download.php?replay=" . $_GET['id'] . "'>Download</a></td>
                        </tr>
                        </table>";
        
        echo $pageData;
    }
    else
    {
        echo "<h2>Couldnt find replay id.";
    }
    

?>
