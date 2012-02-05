<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top_admin.php';

?>

<h3>Zarządzanie konkursami</h3>

<?php

if ($this->getParam('errorMessage')) {
	echo '<p class="dialog d_long d_error">'. $this->getParam('errorMessage') .'</p>';
} else if (is_array($this->getParam('contestInfoList'))) {

	$contests = $this->getParam('contestInfoList');
?>
	
<p>Żaden konkurs nie jest otwarty, ale istnieją zapowiedziane konkursy. Możesz otworzyć jeden z nich:</p>
	
<table>
		
	<thead>
		<td>#</td>
		<td>Data gry</td>
		<td>Nagroda</td>
		<td>Otwórz</td>
	</thead>
			
<?php

	foreach ($contests as $key => $contest) {
	
		echo '<tr>';
		echo '<td>'. $contest['id'] .'</td>';
		echo '<td class="td_tleft">'. date('d.m.Y', $contest['date']) .'</td>';
		echo '<td class="td_tleft">'. $contest['award'] .'</td>';
		echo '<td><a href="#">Otwórz</a></td>';
		echo '</tr>';
	
	}
	
	echo '</table>';
	
} else {

	$contest = $this->getParam('contestInfo');
	
	switch ($contest['status']) {
	
		case 1:	
?>	
	
<p>Obecnie konkurs jest otwarty, można się do niego zapisywać. <a href="#">Kliknij tutaj, aby zamknąć zapisy.</a></p>

<table>
		
	<thead>
		<td>#</td>
		<td>Data gry</td>
		<td>Nagroda</td>
	</thead>
			
	<tr>
		<td><?php echo $contest['id']; ?></td>
		<td class="td_tleft"><?php echo date('d.m.Y, H:i', $contest['date']); ?></td>
		<td class="td_tleft"><?php echo $contest['award']; ?></td>
	</tr>
	
</table>
	
<?php
		break;
		
		case 2:
?>	
	
<p>Obecnie trwa konkurs, zapisy są zamknięte. <a href="?action=transmission">Przejdź do transmisji, aby podać zwycięzcę i zamknąć konkurs.</a></p>

<table>
		
	<thead>
		<td>#</td>
		<td>Data gry</td>
		<td>Nagroda</td>
	</thead>
			
	<tr>
		<td><?php echo $contest['id']; ?></td>
		<td class="td_tleft"><?php echo date('d.m.Y, H:i', $contest['date']); ?></td>
		<td class="td_tleft"><?php echo $contest['award']; ?></td>
	</tr>
	
</table>
	
<?php
		break;
	
	}

}

?>

<?php

require INCPATH.'footer.php';

?>