<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

if (!isset($_POST['user']['login'])) {

	// Nie wysłano formularza

	if ($this->checkForView('registerform')) {
		$this->setParam('subtitle', 'Rejestracja');
		$this->setParam('formLocation', 'index.php?action=register');
		$this->setView('registerform');
	} else {
		$this->setParam('404', 'Szukany widok nie istnieje!');
		throw new Exception('Szukany widok nie istnieje!');
	}

} else if ($_POST['user']['login'] == '' || $_POST['user']['password1'] == '' || $_POST['user']['password2'] == '' || $_POST['user']['mail1'] == '' || $_POST['user']['mail2'] == '') {

	$this->setParam('formErrors', array('emptyfields' => 'Nie wypełniono wszystkich pól formularza!'));
	
	if ($this->checkForView('registerform')) {
		$this->setParam('subtitle', 'Rejestracja');
		$this->setParam('formLocation', 'index.php?action=register');
		$this->setView('registerform');
	} else {
		$this->setParam('404', 'Szukany widok nie istnieje!');
		throw new Exception('Szukany widok nie istnieje!');
	}	

} else {

	if (!Validator::Word($_POST['user']['login'])  || Validator::Text($_POST['user']['login'], true) != $_POST['user']['login']) {
		$formErrors['login'] = 'Podany login jest nieprawidłowy.';
	}
	
	if (Validator::Text($_POST['user']['password1'], true) != $_POST['user']['password1'] || Validator::Text($_POST['user']['password2'], true) != $_POST['user']['password2']) {
		$formErrors['password'] = 'Wybrane hasło jest nieprawidłowe.';
	} else if ($_POST['user']['password1'] != $_POST['user']['password2']) {
		$formErrors['password'] = 'Podane hasła różnią się od siebie.';
	}
	
	if (Validator::Text($_POST['user']['mail1'], true) != $_POST['user']['mail1'] || Validator::Text($_POST['user']['mail2'], true) != $_POST['user']['mail2'] || !Validator::Email($_POST['user']['mail1']) || !Validator::Email($_POST['user']['mail2'])) {
		$formErrors['mail'] = 'Podano nieprawidłowy adres email.';
	} else if ($_POST['user']['mail1'] != $_POST['user']['mail2']) {
		$formErrors['mail'] = 'Podane adresy e-mail różnią się od siebie.';
	}
	
	if (!Validator::Digit($_POST['user']['phone']) || strlen($_POST['user']['phone']) != 9) {
		$formErrors['phone'] = 'Podany numer telefonu nie jest prawidłowy.';
	}
	
	if (is_array($formErrors)) {
	
		$this->setParam('formErrors', $formErrors);
	
		if ($this->checkForView('registerform')) {
			$this->setParam('subtitle', 'Rejestracja');
			$this->setParam('formLocation', 'index.php?action=register');
			$this->setView('registerform');
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
			
			$registerStatus = UserManager::addUser($_POST['user']['login'], $_POST['user']['password1'], $_POST['user']['mail1'], $_POST['user']['phone']);
			
			if ($registerStatus == -1) {
				$formErrors['login'] = 'Istnieje już użytkownik o loginie '. $_POST['user']['login'] .'.';
				$_POST['user']['login'] = '';
				throw new Exception('Istnieje już użytkownik o takim loginie.');
			}
			
			if ($this->checkForView('registerthankyou')) {
				$this->setParam('subtitle', 'Rejestracja');
				$this->setView('registerthankyou');
			} else {
				$this->setParam('404', 'Szukany widok nie istnieje!');
				throw new Exception('Szukany widok nie istnieje!');
			}
			
		} catch (Exception $e) {
		
			$formErrors['emptyfields'] = 'Nie udało się zarejestrować nowego użytkownika.';
			$this->setParam('formErrors', $formErrors);
			
			if ($this->checkForView('registerform')) {
				$this->setParam('subtitle', 'Rejestracja');
				$this->setParam('formLocation', 'index.php?action=register');
				$this->setView('registerform');
			} else {
				$this->setParam('404', 'Szukany widok nie istnieje!');
				throw new Exception('Szukany widok nie istnieje!');
			}
		
		}
	
	}
	
}

?>