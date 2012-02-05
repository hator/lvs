<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top_admin.php';

if ($this->getParam('successMessage')) {
?>

<h3>Dodaj konkurs - Konkurs dodany!</h3>

<p>Twój konkurs został dodany. Teraz możesz przejść do <a href="?action=admin&task=contests">administracji konkursami</a>, aby otworzyć jeden z nich.</p>

<?php
} else {

?>

<h3>Dodaj konkurs</h3>

<p>Wypełnij formularz. Dodany konkurs zostanie określony jako oczekujący do otwarcia.</p>
		
<form class="contestform" action="<?php echo $this->getParam('formLocation'); ?>" method="post">

<?php

if ($this->getParam('sqlMessage')) {
	echo '<p class="dialog d_error">Nie udało się dodać konkursu do bazy danych.</p>';
}

if ($this->getParam('emptyMessage')) {
	echo '<p class="dialog d_error">Nie wypełniono wszystkich pól formularza!</p>';
}

if ($this->getParam('dateMessage')) {
	echo '<p class="dialog d_error">Podana data nie jest prawidłowa!</p>';
}

?>
		
	<label for="contest[date_day]">Data (format DD-MM-RRRR):</label>

	<input type="text" name="contest[day]" class="form_cdate form_fleft" />
	<span class="form_cseparation">-</span>
	<input type="text" name="contest[month]" class="form_cdate form_fleft" />
	<span class="form_cseparation">-</span>
	<input type="text" name="contest[year]" class="form_cdate form_fleft" style="width: 35px !important;" />
			
	<label for="contest[date_hours]">Czas (format GG:MM):</label>
			
	<input type="text" name="contest[hours]" class="form_cdate form_fleft" />
	<span class="form_cseparation">:</span>
	<input type="text" name="contest[minutes]" class="form_cdate form_fleft" />
			
	<label for="contest[award]">Nagroda:</label>
	<input type="text" name="contest[award]" class="form_fleft" />
			
	<input type="submit" value="Dodaj konkurs" class="form_submit" />
		
</form>

<?php

}

require INCPATH.'footer.php';

?>