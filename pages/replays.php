<?php    
    if(isset($_GET['from']))
    {
        $fromentry = $_GET['from'];
    } 
    else
    {
        $fromentry = 0;
    }    
    
    echo "  <table class='replaytable'>
            <tr>                
                <th width='30'><p class='tableheader'>ID</p></th>
                <th width='200'><p class='tableheader'>Title</p></th>
                <th width='100'><p class='tableheader'>Uploaded by</p></th>
                <th width='115'><p class='tableheader'>Map</p></th>
                <th width='120'><p class='tableheader'>Mode</p></th>
                <th width='150'><p class='tableheader'>Upload Date</p></th>
                <th width='60'><p class='tableheader'>Info</p></th>
                <th width='60'><p class='tableheader'># DL's</p></th>
            </tr>";
    $result = getReplaysPage($fromentry);
    $nrOfReplays = countReplays();
    
    while($line = mysql_fetch_array($result))
    {
        echo "<tr class='replayrow'>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['replayId'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['title'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['username'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['mapName'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['nrOfPlayersTeam1'] . "v" . $line['nrOfPlayersTeam2'] . " - " . $line['gameModeName'] . "</p></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['uploadDate'] . "</p></td>" .
                "<td class='replaystd'><a href='index.php?page=replay&id=" . $line['replayId'] . "'>Details</a></td>" .
                "<td class='replaystd'><p class='tablecell'>" . $line['downloadCounter'] . "</a></td>" .
             "<tr>";
    }

    echo "  </table>";
    echo "";
    
    $browseReplaysCounter = 0;
    echo "<table width='100%'><tr><td width='45%'><p class='lastpagelinks'>";
    while($browseReplaysCounter < $nrOfReplays) 
    {        
        $page = ($browseReplaysCounter + $replaysPrPage)/$replaysPrPage;
        if($browseReplaysCounter < $fromentry)
        {
            echo "<a href='index.php?page=replays&from=" . $browseReplaysCounter . "'>" . intval($page) . "</a>";
        }        
        else if($browseReplaysCounter == $fromentry)
        {
            
            $browseReplaysCounter = $browseReplaysCounter + $replaysPrPage;
            echo "</p></td><td width='10%'><p class='curpage'>  " . $page . "</p></td><td width='45%'><p class='nextpagelinks'>";
            continue;
        }            
        else
        {
            echo "<a href='index.php?page=replays&from=" . $browseReplaysCounter . "'>" . intval($page) . "</a>";
        }
        $browseReplaysCounter = $browseReplaysCounter + $replaysPrPage;
    }
        
    
    echo "</p></td></tr></table>";
    
?>
