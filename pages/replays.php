<?php    
    if(isset($_GET['from']))
    {
        $fromentry = $_GET['from'];
    } 
    else
    {
        $fromentry = 0;
    }    
    
    echo "  <h2>Displaying replays</h2>
        <div class='pagecontentbox'>
            <ul class='replay_index'>
            ";
    $result = getReplaysPage($fromentry);
    $nrOfReplays = countReplays();
    
    while($line = mysql_fetch_array($result))
    {
        echo "<li class='replay_item'><a class='replay_link' href='index.php?page=replay&id=" . $line['replayId'] . "'></a></li>";
    }

    echo "</ul>";
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
        
    
    echo "</p></td></tr></table></div>";
    
?>
