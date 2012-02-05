<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top_admin.php';

?>

<h3>Konkursy</h3>

<p>Poniżej widnieje spis wszystkich konkursów. Kliknij w status, aby zmienić status konkursu. Może istnieć jedynie jeden konkurs o statusie "Trwający" lub "Trwają zapisy".</p>

<?php

if ($this->getParam('errorMessage')) {
	echo '<p class="dialog d_long d_error">'. $this->getParam('errorMessage') .'</p>';
} else  {

	if ($this->getParam('infoMessage')) {
		echo '<p class="dialog d_long d_info">'. $this->getParam('infoMessage') .'</p>';
	}

	$contests = $this->getParam('contests');

?>

<table>
		
			<thead>
				<td>#</td>
				<td>Data</td>
				<td>Zwycięzca</td>
				<td>Nagroda</td>
				<td>Status</td>
			</thead>

<?php

	foreach ($contests as $key => $contest) {
	
		echo '<tr>';
		echo '<td>'. $contest['id'] .'</td>';
		echo '<td class="td_tleft">'. date('d.m.Y, H:i', $contest['date']) .'</td>';
		
		// Winner of contest
		echo '<td class="td_tleft">';
		
		if ($contest['login']) {
			echo $contest['login'];
		} else {
			echo '-';
		}
		
		echo '</td>';
		
		echo '<td class="td_tleft">'. $contest['award'] .'</td>';
		
		// Contest status
		echo '<td class="td_tleft"><a href="?action=admin&task=contests&change='. $contest['id'] .'">';
		
		switch ($contest['status']) {
		
			case 3:
				echo 'Zakończony';
			break;
			
			case 2:
				echo 'Trwający';
			break;
			
			case 1:
				echo 'Trwają zapisy';
			break;
			
			case 0:
				echo 'Oczekujący';
			break;
		
		}
		
		echo '</a></td>';
		
		echo '</tr>';
	
	}

	echo '</table>';

}

require INCPATH.'footer.php';

?>