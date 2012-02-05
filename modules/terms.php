<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

if ($this->checkForView('terms')) {
	$this->setParam('subtitle', 'Regulamin');
	$this->setView('terms');
} else {
	$this->setParam('404', 'Szukany widok nie istnieje!');
	throw new Exception('Szukany widok nie istnieje!');
}

?>