<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require_once BASEPATH.'core/winnerssqllist.class.php';

$winnersList = WinnersSQLList::getWinnersList();

if (is_array($winnersList)) {
	$this->setParam('winnersList', $winnersList);
} else {
	$this->setParam('infoMessage', 'Brak konkursów do wyświetlenia');
}

$this->setView('winners');

?>