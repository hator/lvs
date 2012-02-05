<?php

$this->setParam('subtitle', 'HTTP 404');
require INCPATH.'top.php';

?>		<h2 id="http_error">DOSTĘP</h2>
		<p id="http_error_msg">Nie jesteś zalogowany jako administrator.</p>
		<p><a href="?action=login">Zaloguj się jako administrator</a> lub wybierz jedną z pozycji menu.</p>
<?php
		
require INCPATH.'footer.php';

?>