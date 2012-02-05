<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top.php';

?>

<div id="admin_header">
	
	<h2>Administracja</h2>
		
	<ul id="admin_menu">
		<li><a href="?action=admin&task=contests">Konkursy</a></li>
		<li><a href="?action=admin&task=add_contest">Dodaj konkurs</a></li>
		<li><a href="?action=admin&task=admins">Administratorzy</a></li>
	</ul>
		
</div>