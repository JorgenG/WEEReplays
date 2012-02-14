<?php    
    if(isset($_POST['from']))
    {
        $page = $_POST['from'];
    } 
    else
    {
        $page = 0;
    }
    echo "  <table class='replaytable'>
            <tr>                
                <th width='200'>Title</th>
                <th width='100'>Author</th>
                <th width='140'>Map</th>
                <th width='70'>Players</th>
                <th width='100'>Mode</th>
                <th width='150'>Upload Date</th>
                <th width='60'>Download</th>
            </tr>";
    $result = getReplaysPage($page);
    
    while($line = mysql_fetch_array($result))
    {
        echo "<tr>" .
                "<td class='replaystd'>" . $line['title'] . "</td>" .
                "<td class='replaystd'>" . $line['username'] . "</td>" .
                "<td class='replaystd'>" . $line['mapName'] . "</td>" .
                "<td class='replaystd'>" . $line['nrOfPlayersTeam1'] . "v" . $line['nrOfPlayersTeam2'] . "</td>" .
                "<td class='replaystd'>" . $line['gameModeName'] . "</td>" .
                "<td class='replaystd'>" . $line['uploadDate'] . "</td>" .
                "<td class='replaystd'><a href='index.php?page=replay&id=" . $line['replayId'] . "'>Details</a></td>" .
             "<tr>";
    }

    echo "  </table>";
    
?>
