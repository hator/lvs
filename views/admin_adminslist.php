<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top_admin.php';

?>

<h3>Administratorzy</h3>

<p>Poniżej widnieje lista użytkowników z uprawnieniami administratora. Administratorzy mogą zmieniać status konkursów, a także dodawać nowe.</p>

<?php

if ($this->getParam('errorMessage')) {

	echo '<p class="dialog d_long d_error">'. $this->getParam('errorMessage') .'</p>';

} else {
?>
	
<table>
		
			<thead>
				<td>ID</td>
				<td>Login</td>
				<td>Adres e-mail</td>
				<td>Telefon</td>
			</thead>
	
<?php

	$adminsList = $this->getParam('adminsList');
	
	foreach ($adminsList as $key => $admin) {
	
		echo '<tr>';
		echo '<td>'. $admin['id'] .'</td>';
		echo '<td class="td_tleft">'. $admin['login'] .'</td>';
		echo '<td class="td_tleft">'. $admin['mail'] .'</td>';
		echo '<td class="td_tleft">'. $admin['tel'] .'</td>';
		echo '</tr>';
	
	}
	
	echo '</table>';

}

require INCPATH.'footer.php';

?>