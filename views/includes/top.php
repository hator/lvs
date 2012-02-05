<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="utf-8" />
	<title><?php
	
		echo Config::$site['title'];
	
		if ($this->getParam('subtitle'))
			echo ' :: '. $this->getParam('subtitle');
	

	?></title>
	<link rel="stylesheet" href="<?php echo INCPATH; ?>stylesheet.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.1.min.js"></script>

<script type="text/javascript">

function blink(color) {
	
	if ( $('#atrans').css('color') == 'rgb(255, 153, 0)') {
		$('#atrans').css({"color": 'rgb(180, 108, 0)'});
	} else {
		$('#atrans').css({"color": 'rgb(255, 153, 0)'});
	}
	
}


$(document).ready(function () {
	setInterval(blink, 1000);
});

</script>
	
</head>
<body id="<?php echo $this->getView(); ?>">

<div id="wrapper">

	<header id="mheader">
		<h1><a href="?"><?php echo Config::$site['title']; ?></a></h1>
<?php

	try {

		include_once BASEPATH.'core/contestcounter.class.php';
		
		if (ContestCounter::isOpened() == 2) {
			echo '<p>Aktualnie trwa konkurs.</p>';
		} else if (ContestCounter::isOpened() == 1) {
			echo '<p>Za chwilę pokój zostanie otwarty.</p>';
		} else {
		
			$nc = ContestCounter::nextContest();
			
			if (!$nc) {
				echo '<p>Narazie nie przewidziano żadnych konkursów.</p>';
			} else {
				echo '<p>Następny konkurs: '. date('d.m.Y, H:i', $nc) .' ('. date('H:i', $nc - Config::$lottery['join_time']) .')</p>';
			}
		
		}
	
	} catch (Exception $e) {
		echo '<p>'. date('U') .'Brak informacji o konkursach</p>';
	}

?>
	</header>

	<nav id="mnav">
		<ul>
			
			<?php
			
				if (isset($_SESSION['id'])) {
				
					// Logged in menu
					echo '<li><a href="?action=logout">Wyloguj</a></li>';
					echo '<li><a href="?action=winners">Zwycięzcy</a></li>';
					echo '<li><a href="?action=transmission" id="atrans">Transmisja</a></li>';
					echo '<li><a href="?action=terms">Regulamin</a></li>';
					echo '<li><a href="?action=admin">Administracja</a></li>';
					
				} else {
				
					// Not logged in menu
					echo '<li><a href="?action=login">Zaloguj</a></li>';
					echo '<li><a href="?action=register">Rejestracja</a></li>';
					echo '<li><a href="?action=transmission" id="atrans">Transmisja</a></li>';
					echo '<li><a href="?action=winners">Zwycięzcy</a></li>';
					echo '<li><a href="?action=terms">Regulamin</a></li>';
					
				}	
			?>
		</ul>
	</nav>
	
	<div id="content">