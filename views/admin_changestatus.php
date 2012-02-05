<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top_admin.php';

?>

<h3>Konkursy - Zmiana typu</h3>
<p>Wybierz nowy status konkursu (może istnieć tylko jeden konkurs o statusie "Trwający" lub "Trwają zapisy"):</p>

<?php

if ($this->getParam('infoMessage')) {
	echo '<p class="dialog d_long d_info">'. $this->getParam('infoMessage') .'</p>';
}

if ($this->getParam('errorMessage')) {
	echo '<p class="dialog d_long d_error">'. $this->getParam('errorMessage') .'</p>';
}

?>
	
<form id="statusform" action="?action=admin&task=contests&change=<?php echo $_GET['change']; ?>" method="post">
		
	<input type="radio" name="contest[status]" value="0" />
	<h4>Oczekujący</h4>
	<p>Konkurs jest zapowiedziany. Po otworzeniu go będzie można się zapisać.</p>
			
	<input type="radio" name="contest[status]" value="1" />
	<h4>Trwają zapisy</h4>
	<p>Zalogowani użytkownicy sa dodawani do kokursu, o ile nie wylogują się przed zamknięciem zapisów.</p>
			
	<input type="radio" name="contest[status]" value="2" />
	<h4>Trwający</h4>
	<p>Trwa loteria, nie można się już zapisywać.</p>
			
	<input type="radio" name="contest[status]" value="3" />
	<h4>Zakończony</h4>
	<p>Konkurs jest zakończony, pojawi się na liście "Zwycięzcy".</p>
			
	<input type="submit" value="Zmień status" class="form_submit" />
		
</form>
	
<?php

require INCPATH.'footer.php';

?>