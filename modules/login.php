<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

if (!isset($_POST['user']['login'])) {

	if ($this->checkForView('loginform')) {
		$this->setParam('subtitle', 'Logowanie');
		$this->setParam('formLocation', 'index.php?action=login');
		$this->setView('loginform');
	} else {
		$this->setParam('404', 'Szukany widok nie istnieje!');
		throw new Exception('Szukany widok nie istnieje!');
	}

} else if ($_POST['user']['login'] == '' || $_POST['user']['password'] == '') {

	$this->setParam('loginError', 'Nie wypełniono wszystkich pól formularza!');
	
	if ($this->checkForView('loginform')) {
		$this->setParam('subtitle', 'Logowanie');
		$this->setParam('formLocation', 'index.php?action=login');
		$this->setView('loginform');
	} else {
		$this->setParam('404', 'Szukany widok nie istnieje!');
		throw new Exception('Szukany widok nie istnieje!');
	}	

} else if (!Validator::Word($_POST['user']['login'])  || Validator::Text($_POST['user']['login'], true) != $_POST['user']['login'] || Validator::Text($_POST['user']['password'], true) != $_POST['user']['password']) {

	$this->setParam('loginError', 'Podane dane nie są prawidłowe!');
	
	if ($this->checkForView('loginform')) {
		$this->setParam('subtitle', 'Logowanie');
		$this->setParam('formLocation', 'index.php?action=login');
		$this->setView('loginform');
	} else {
		$this->setParam('404', 'Szukany widok nie istnieje!');
		throw new Exception('Szukany widok nie istnieje!');
	}

} else {

	try {
		require_once BASEPATH.'core/usermanager.class.php';
	} catch (Exception $e) {
		throw new Exception('Nie można załadować pliku obsługi użytkowników!');
	}
	
	try {
	
		UserManager::login($_POST['user']['login'], $_POST['user']['password']);
		$this->setParam('loginSuccess', '1');
		$this->setView('main');
		
	} catch (Exception $e) {
		
		$this->setParam('loginError', 'Podane login i hasło nie są prawidłowe!');
		
		if ($this->checkForView('loginform')) {
			$this->setParam('subtitle', 'Logowanie');
			$this->setParam('formLocation', 'index.php?action=login');
			$this->setView('loginform');
		} else {
			$this->setParam('404', 'Szukany widok nie istnieje!');
			throw new Exception('Szukany widok nie istnieje!');
		}
		
	}
	
}

?>