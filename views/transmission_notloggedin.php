<?php

$this->setParam('subtitle', 'HTTP 404');
require INCPATH.'top.php';

?>		<h2 id="http_error">ZALOGUJ</h2>
		<p id="http_error_msg">Nie jesteś zalogowany. Nie możesz oglądać transmisji.</p>
		<p><a href="?action=login">Zaloguj się</a> lub wybierz jedną z pozycji menu.</p>
<?php
		
require INCPATH.'footer.php';

?>