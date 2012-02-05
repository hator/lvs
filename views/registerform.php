<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top.php';

if (is_array($this->getParam('formErrors'))) {
	$formErrors = $this->getParam('formErrors');
}

?>		<h2>Formularz rejestracyjny</h2>
		
		<form action="<?php echo $this->getParam('formLocation'); ?>" method="post">
		
<?php

	if ($formErrors['emptyfields'] != '') {
		echo '<p class="dialog d_error">'. $formErrors['emptyfields'] .'</p>';
	}

	if ($formErrors['login'] != '') {
		echo '<p class="dialog d_error">'. $formErrors['login'] .'</p>';
	}

?>
		
			<label for="user[login]">Login: <span style="font-size: 9px;">(znaki alfanumeryczne)</span></label>
			<input type="text" name="user[login]" class="form_fleft" value="<?php echo Validator::Text($_POST['user']['login'], true); ?>" />
			
<?php

	if ($formErrors['password'] != '') {
		echo '<p class="dialog d_error">'. $formErrors['password'] .'</p>';
	}

?>
			
			<label for="user[password1]">Hasło:</label>
			<input type="password" name="user[password1]" class="form_fleft" />
			
			<label for="user[password2]">Powtórz hasło:</label>
			<input type="password" name="user[password2]" class="form_fleft" />
			
<?php

	if ($formErrors['mail'] != '') {
		echo '<p class="dialog d_error">'. $formErrors['mail'] .'</p>';
	}

?>		
	
			<label for="user[mail1]">Adres e-mail:</label>
			<input type="text" name="user[mail1]" class="form_fleft" value="<?php echo Validator::Text($_POST['user']['mail1'], true); ?>" />
			
			<label for="user[mail2]">Powtórz adres e-mail:</label>
			<input type="text" name="user[mail2]" class="form_fleft" value="<?php echo Validator::Text($_POST['user']['mail2'], true); ?>" />
			
<?php

	if ($formErrors['phone'] != '') {
		echo '<p class="dialog d_error">'. $formErrors['phone'] .'</p>';
	}

?>				

			<label for="user[mail2]">Telefon (9 cyfr):</label>
			<input type="text" name="user[phone]" class="form_fleft" value="<?php echo Validator::Text($_POST['user']['phone'], true); ?>" />
			
			<input type="submit" value="Zarejestruj się!" class="form_submit" />
		
		</form>
<?php
		
require INCPATH.'footer.php';

?>