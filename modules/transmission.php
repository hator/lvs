<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

$this->setParam('subtitle', 'Transmisja');

if (!isset($_SESSION['id'])) {

	$this->setParam('subtitle', 'Transmisja');
	$this->setView('transmission_notloggedin');

} else {

	try {
	
		require_once BASEPATH.'core/contestcounter.class.php';
		
		$status1 = ContestCounter::contestByStatus(1);
		
		if (is_array($status1)) {
			$this->setParam('infoMessage', 'Trwają zapisy do konkursu. Czas otwarcia pokoju: '.date('m.d.Y, H:i', $status1['date']));
			$this->setView('transmission_notnow');
		} else if (!ContestCounter::contestByStatus(2)) {
			
			$next = ContestCounter::nextContest();
			
			if (!$next) {
				$this->setParam('infoMessage', 'Aktualnie nie ma żadnego konkursu.');
				$this->setParam('errorMessage', 'Nie można załadować danych następnego konkursu lub nie został zapowiedziany.');
				$this->setView('transmission_notnow');
			} else {
				$this->setParam('infoMessage', 'Aktualnie nie ma żadnego konkursu. Nastepny konkurs: '.date('m.d.Y, H:i', $next));
				$this->setView('transmission_notnow');
			}
		} else {
		
			// TODO: TRANSMISSION IF THERE IS ACTIVE CONTEST ROOM!
		
		}
	
	} catch (Exception $e) {
	
		$this->setParam('errorMessage', 'Nie udało się załadować potrzebnych danych. Spróbuj ponownie później.');
		$this->setView('transmission_notnow');
	
	}

	

}

?>