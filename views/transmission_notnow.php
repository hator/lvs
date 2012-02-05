<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top.php';

?>

<h2>Transmisja</h2>

<?php

if ($this->getParam('infoMessage')) {
	echo '<p class="dialog d_long d_info">'. $this->getParam('infoMessage') .'</p>';
}
if ($this->getParam('errorMessage')) {
	echo '<p class="dialog d_long d_error">'. $this->getParam('errorMessage') .'</p>';
}

require INCPATH.'footer.php';

?>