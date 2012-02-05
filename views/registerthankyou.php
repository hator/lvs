<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top.php';

for ($i=0; $i<strlen($_POST['user']['login']); $i++) {
	$maskedpass .= '*';
}

?>

<h2>Zostałeś zarejestrowany!</h2>

		<p>Dziękujemy za rejestrację. Poniżej widnieją twoje dane:</p>
		
		<ul>
		
			<li>Login: <?php echo $_POST['user']['login']; ?></li>
			<li>Hasło: <?php echo $maskedpass; ?></li>
	
		</ul>
		
		<p>Teraz możesz się zalogować klikając <a href="?action=login">tutaj</a>.</p>

<?php

require INCPATH.'footer.php';

?>