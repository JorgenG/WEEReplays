<?php
echo "  <h2>Enter information for replay</h2>
    <div id='addreplayform'>
    <form action='index.php?page=upload' method=post enctype='multipart/form-data'>
        <table class='registertable'>
            
            <tr>
                <td class='formlabel' align='right'>
                    <label for='title'>Title:</label>
                </td>
                <td class='forminput'>
                    <input class='addrplinput' size='40' type='text' name='title' />
                </td>
            </tr>
            <tr>
                <td class='formlabel' align='right'>
                    <label for='information'>Description:</label>
                </td>
                <td class='forminput'>
                    <textarea name='description' rows='5' cols='40'></textarea>
                </td>
            </tr>
            <tr>
                <td class='formlabel' align='right'>
                    <label for='file'>Select file:</label>
                </td>
                <td class='forminput'>
                    <input type='file' name='file'/>
                </td>
            </tr>
            <tr>
                <td class='formlabel' align='right'>
                    <label for='factions'>Factions:</label>
                </td>
                <td class='forminput'>
                    <select name='factions'>
                        <option value='nvp'>NATO vs PACT</option>
                        <option value='nvn'>NATO vs NATO</option>
                        <option value='nvp'>PACT vs PACT</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class='formlabel' align='right'>
                    <label for='players'># of Players:</label>
                </td>
                <td class='forminput'>
                    <select name='nrOfPlayers'>
                        <option value='1v1'>1v1</option>
                        <option value='2v2'>2v2</option>
                        <option value='3v3'>3v3</option>
                        <option value='4v4'>4v4</option>
                        <option value='other'>Other</option>
                    </select>
                </td>
                <td>
                    <p>If other: <input size='5' type='text' name='other'/></p>
                </td>
            </tr>
            <tr>
                <td class='formlabel' align='right'>
                    <label for='map'>Map:</label>
                </td>
                <td class='forminput'>
                    <select name='map'>
            ";
    $mapResult = getMaps();

    while($map = mysql_fetch_array($mapResult)) 
    {
        echo "<option value='" . $map['mapId'] . "'>" . $map['mapName'] . "</option>";
    }
                        
    echo           "</select>
                </td>
            </tr>
            <tr>
                <td class='formlabel' align='right'>
                    <label for='mode'>Mode:</label>
                </td>
                <td class='forminput'>
                    <select name='mode'>";
    
    $modeResult = getModes();
    
    while($mode = mysql_fetch_array($modeResult))
    {
        echo "<option value='" . $mode['gameModeId'] . "'>" . $mode['gameModeName'] . "</option>";
    }
    
    echo           "</select>
                </td>
            </tr>
            <tr>
                <td class='formlabel' align='right'>
                    
                </td>
                <td class='forminput'>
                    <input type='submit' name='submit' value='Submit' />
                </td>
            </tr>
        </table>

        <br />

        </form>
    </div>";
?>
