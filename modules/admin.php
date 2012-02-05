<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

$this->setParam('subtitle', 'Administracja');

if ($_SESSION['admin'] != 1) {

	$this->setView('admin_notloggedin');

} else {

	switch ($_GET['task']) {
	
		case 'contests':
		
			if ($_GET['change'] != '') {
			
				if ($_POST['contest'] != '') {
				
					require_once BASEPATH.'core/contestcounter.class.php';
					$changing_status = ContestCounter::changeStatus($_GET['change'], $_POST['contest']['status']);
					
					if ($changing_status == -1) {
						$this->setParam('errorMessage', 'Nie udało się zmienić statusu konkursu.');
						$this->setView('admin_changestatus');
					} else if ($changing_status == 0) {
						$this->setParam('errorMessage', 'Istnieje już konkurs o statusie "Trwający" lub "Trwają zapisy". Zmień status aktualnego konkursu, aby ustawić ten jako aktywny.');
						$this->setView('admin_changestatus');
					} else {
					
						$this->setParam('infoMessage', 'Status konkursu został zmieniony.');
						
						$contests_list = ContestCounter::listOfContests();
			
						if (is_array($contests_list)) {
							$this->setParam('contests', $contests_list);
						} else {
							$this->setParam('errorMessage', 'Nie udało się pobrać listy konkursów lub nie istnieją żadne konkursy.');
						}
		
						$this->setView('admin_listofcontests');
						
					}
				
				} else {
					$this->setView('admin_changestatus');
				}
			
			} else {
		
				require_once BASEPATH.'core/contestcounter.class.php';
			
				$contests_list = ContestCounter::listOfContests();
				//prelog($contests_list);
			
				if (is_array($contests_list)) {
					$this->setParam('contests', $contests_list);
				} else {
					$this->setParam('errorMessage', 'Nie udało się pobrać listy konkursów lub nie istnieją żadne konkursy.');
				}
		
				$this->setView('admin_listofcontests');
			
			}
		
		break;
	
		/* OLD HANDLER - THERE IS A NEW VERSION
		case 'contests':
		
			require_once BASEPATH.'core/contestcounter.class.php';
		
			switch (ContestCounter::isOpened()) {
			
				case 1:
				
					$contest = ContestCounter::contestByStatus(1);
					
					if (is_array($contest)) {
						$this->setParam('contestInfo', $contest);
					} else {
						$this->setParam('errorMessage', 'Nie udało się pobrać danych konkursu');
					}
				
					$this->setView('admin_contestmanaging');
				
				break;
				
				case 2:
					
					$contest = ContestCounter::contestByStatus(2);
					
					if (is_array($contest)) {
						$this->setParam('contestInfo', $contest);
					} else {
						$this->setParam('errorMessage', 'Nie udało się pobrać danych konkursu');
					}
				
					$this->setView('admin_contestmanaging');
					
				break;
				
				default:
				
					$nc = ContestCounter::nextContest();
			
					if (!$nc) {
						$this->setView('admin_contestslist');
					} else {
						
						$contests = ContestCounter::nextContestsList();
						
						if (!is_array($contests)) {
							$this->setParam('errorMessage', 'Nie udało się pobrać danych konkursu');
						} else {
							$this->setParam('contestInfoList', $contests);
						}
						
						$this->setView('admin_contestmanaging');
						
					}
			
				break;
			
			}
			
		break;
		*/
		
		case 'add_contest':
		
			if (isset($_POST['contest'])) {
			
				try {
			
					foreach ($_POST['contest'] as $key => $value) {
						if (empty($_POST['contest'][$key]) || $_POST['contest'][$key] == '') {
							$this->setParam('emptyMessage', 1);
							throw new Exception('Nie wypełniono wszystkich pól formularza.');
						}
					}
				
					$date_check = date_parse( $_POST['contest']['year'] .'/'. $_POST['contest']['month'] .'/'. $_POST['contest']['day'] .' '. $_POST['contest']['hours'] .':'. $_POST['contest']['minutes'] .':00' );
					
					if ($date_check['error_count'] != 0) {
						$this->setParam('dateMessage', 1);
						throw new Exception('Podana data jest nieprawidłowa.');
					}
				
					$timestamp = mktime($_POST['contest']['hours'], $_POST['contest']['minutes'], 0, $_POST['contest']['month'], $_POST['contest']['day'], $_POST['contest']['year']);
				
					require_once BASEPATH.'core/contestcounter.class.php';
					
					if (!ContestCounter::addContest($timestamp, $_POST['contest']['award'])) {
						$this->setParam('sqlMessage', 1);
						throw new Exception('Nie udało się dodać konkursu do bazy danych.');
					}
				
					$this->setParam('successMessage', 1);
				
				} catch (Exception $e) {
					$this->setParam('formLocation', '?action=admin&task=add_contest');
				}
			
				$this->setView('admin_addcontest');
			
			} else {
		
				$this->setParam('formLocation', '?action=admin&task=add_contest');
				$this->setView('admin_addcontest');
			
			}
			
		break;
		
		case 'admins':
		
			try {
		
				require_once BASEPATH.'core/adminslist.class.php';
				
				$lista = AdminsList::getList();
				
				$this->setParam('adminsList', $lista);
			
			} catch (Exception $e) {
			
				$this->setParam('errorMessage', 'Nie udało się załadować listy administratorów.');
			
			}
			
			$this->setView('admin_adminslist');
		
		break;
	
		default:
			$this->setView('admin');
		break;
	
	}	

}

?>