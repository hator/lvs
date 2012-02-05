<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

if ($this->checkForView('main')) {
	$this->setParam('subtitle', 'Strona główna');
	$this->setView('main');
} else {
	$this->setParam('404', 'Szukany widok nie istnieje!');
	throw new Exception('Szukany widok nie istnieje!');
}

?>