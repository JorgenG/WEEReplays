<div class='visiblediv' id='nav'>
	<ul>
		<li><a <?php if($page == 'home') { echo "id='current'"; } ?> href='index.php?page=home'>Home</a></li>
		<li><a <?php if($page == 'featured') { echo "id='current'"; } ?> href='index.php?page=featured'>Featured</a></li>
		<li><a <?php if($page == 'replays') { echo "id='current'"; } ?> href='index.php?page=replays'>Replays</a></li>
                <li><a <?php if($page == 'addreplay') { echo "id='current'"; } ?> href='index.php?page=addreplay'>Add Replay</a></li>
		<li><a <?php if($page == 'control') { echo "id='current'"; } ?> href='index.php?page=control'>Control Panel</a></li>
	</ul>
</div>