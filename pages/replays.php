<?php    
    if(isset($_GET['from']))
    {
        $fromentry = $_GET['from'];
    } 
    else
    {
        $fromentry = 0;
    }
    
    $nrOfReplays = countReplays();
    
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
    $result = getReplaysPage($fromentry);
    
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
    echo "<p class='nextpagelinks'>";
    
    for($page = 1; $nrOfReplays - $fromentry > 20; $page++)
    {
        $pivot = $fromentry + 20;
        echo "<a href='index.php?page=replays&from=" . $pivot . "'>" . $page . "</a> ";
    }
        
    
    echo "</p>";
    
?>
