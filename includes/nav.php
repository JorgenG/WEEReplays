<div class='visiblediv' id='nav'>
	<ul>
		<?php
                    echoMenuItem($page, "Home", "home", false);
                    echoMenuItem($page, "Replays", "replays", false);
                    echoMenuItem($page, "Add Replay", "addreplay", false);
                    echoMenuItem($page, "New User", "register", true);
                    echoMenuItemForUsersAboveLevel($page, "User", "user", 0);
                ?>
        
        </ul>
</div>