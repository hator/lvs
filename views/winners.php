<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

$this->setParam('subtitle', 'Zwycięzcy');
require INCPATH.'top.php';

?>

<h2>Zwycięzcy</h2>

<?php

if ($this->getParam('infoMessage')) {
	echo '<p class="dialog d_long d_info">'. $this->getParam('infoMessage') .'</p>';
} else {

?>

<table>
		
			<thead>
				<td>#</td>
				<td>Data gry</td>
				<td>Zwycięzca</td>
				<td>Nagroda</td>
			</thead>

<?php

	$winnersList = $this->getParam('winnersList');
	$loop = 1;
	
	foreach ($winnersList as $key => $contest) {
	
		echo '<tr>';
		echo '<td>'. $loop .'</td>';
		echo '<td class="td_tleft">'. date('d.m.Y', $contest['date']) .'</td>';
		echo '<td class="td_tleft">'. $contest['login'] .'</td>';
		echo '<td class="td_tleft">'. $contest['award'] .'</td>';
		echo '</tr>';
		
		$loop++;
	
	}
	
	echo '</table>';

}

require INCPATH.'footer.php';

?>