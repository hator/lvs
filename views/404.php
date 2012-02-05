<?php

$this->setParam('subtitle', 'HTTP 404');
require INCPATH.'top.php';

?>		<h2 id="http_error">HTTP 404</h2>
		<p id="http_error_msg">Wystąpił błąd HTTP 404 - <?php
	
		if ($this->getParam('404'))
			echo $this->getParam('404');
		else
			echo 'Nie można odnaleźć pliku.';
		
?></p>
		<p><a href="?">Przejdź do strony głównej</a> lub wybierz jedną z pozycji menu.</p>
<?php
		
require INCPATH.'footer.php';

?>