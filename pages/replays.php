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
                <th width='200'><p class='tableheader'>Title</p></th>
                <th width='100'><p class='tableheader'>Author</p></th>
                <th width='140'><p class='tableheader'>Map</p></th>
                <th width='70'><p class='tableheader'>Players</p></th>
                <th width='100'><p class='tableheader'>Mode</p></th>
                <th width='150'><p class='tableheader'>Upload Date</p></th>
                <th width='60'><p class='tableheader'>Download</p></th>
            </tr>";
    $result = getReplaysPage($page);
    
    while($line = mysql_fetch_array($result))
    {
        echo "<tr>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['title'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['username'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['mapName'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['nrOfPlayersTeam1'] . "v" . $line['nrOfPlayersTeam2'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['gameModeName'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['uploadDate'] . "</p></td>" .
                "<td class='replaystd'><a href='index.php?page=replay&id=" . $line['replayId'] . "'>Details</a></td>" .
             "<tr>";
    }

    echo "  </table>";
    
?>
