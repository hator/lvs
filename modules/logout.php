<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

if (isset($_SESSION['id'])) {

	require_once BASEPATH.'core/usermanager.class.php';
	UserManager::logout();
	
	$this->setParam('infoMessage', 'Pomyślnie wylogowano.');
	$this->setView('main');

} else {

	$this->setParam('infoMessage', 'Nie jesteś zalogowany.');
	$this->setView('main');

}

?>