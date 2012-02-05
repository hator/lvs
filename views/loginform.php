<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top.php';

?>		<h2>Logowanie</h2>
		
		<form action="<?php echo $this->getParam('formLocation'); ?>" method="post">
		
<?php

	if ($this->getParam('loginError'))
		echo '<p class="dialog d_error">'. $this->getParam('loginError') .'</p>';

?>
		
			<label for="user[login]" class="form_lshort">Login:</label>
			<input type="text" name="user[login]" class="form_fleft_short" value="<?php echo Validator::Text($_POST['user']['login'], true); ?>" />
			
			<label for="user[password]" class="form_lshort">Hasło:</label>
			<input type="password" name="user[password]" class="form_fleft_short" />
			
			<input type="submit" value="Zaloguj się!" class="form_submit" />
		
		</form>
<?php
		
require INCPATH.'footer.php';

?>