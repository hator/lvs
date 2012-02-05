<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

require INCPATH.'top.php';

?>

<div id="jscounter">

<?php

include_once BASEPATH.'core/contestcounter.class.php';

if (ContestCounter::isOpened() == 2) {
	echo '<h3>Przejdź do</h3>';
	echo '<a href="?action=transmission">KONKURSU</a>';
} else if (ContestCounter::isOpened() == 1) {

	$nc = ContestCounter::contestByStatus(1);
	$nc = $nc['date'];

} else if (!$nc) {
	echo '<h3>Nie zapowiedziano</h3>';
	echo '<p>KONKURSÓW</p>';
}

?>

</div>

<script type="text/javascript">

/*
Author: Robert Hashemian
http://www.hashemian.com/

You can use this code in any manner so long as the author's
name, Web address and this disclaimer is kept intact.

Modified by Krzysztof Antoniak <knt.antoniak@gmail.com>
*/

TargetDate = "<?php echo date('m/d/Y h:i A', $nc); ?>";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "<h3>Następny konkurs za:</h3><p>%%D%%<span>:</span>%%H%%<span>:</span>%%M%%<span>:</span>%%S%%</p>";
FinishMessage = "<h3>Przejdź do</h3><a href=\"?action=transmission\">KONKURSU</a>";

function calcage(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (LeadingZero && s.length < 2)
    s = "0" + s;
  return s;
}

function CountBack(secs) {
  if (secs < 0) {
    document.getElementById("jscounter").innerHTML = FinishMessage;
    return;
  }
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

  document.getElementById("jscounter").innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
}

CountStepper = Math.ceil(CountStepper);
if (CountStepper == 0)
  CountActive = false;
var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
var dthen = new Date(TargetDate);
var dnow = new Date();
if(CountStepper>0)
  ddiff = new Date(dnow-dthen);
else
  ddiff = new Date(dthen-dnow);
gsecs = Math.floor(ddiff.valueOf()/1000);

<?php if (ContestCounter::isOpened() != 2 && $nc != 0) { ?>

/* Starts only if there is a contest */
$(document).ready(function () {
	CountBack(gsecs);
});

<?php } ?>

</script>

<div id="maincontent">

<h2>Strona główna</h2>

<?php
// Główna witryna
// TODO: Dodać treść strony głównej!

if ($this->getParam('loginSuccess') == 1) {
	echo '<p class="dialog d_long d_success">Zalogowano pomyślnie!</p>';
}

if ($this->getParam('infoMessage')) {
	echo '<p class="dialog d_long d_info">'. $this->getParam('infoMessage') .'</p>';
}

?>

<p>Miejsca wkoło sarnie i patrzył wzrokiem śmiałym, w szkole. Ale co dzień powszedni. Nóżek, choć zawsze i przysłonił chciał zamku, właśnie i posępny obok pan Wojski z domu lasami i cztery źrenic gorzały przeciw czarów. Raz w modzie był to mówiąc, że gotyckiej są łąki i swój kielich nalać i mniej pilni. Tadeusz Telimenie, Asesor Krajczance a potem się chce rozbierać. Woźny trybunału. Takie były rączki, co je napełnił myślami. Po wielu latach dojrzałą. Lecz wtenczas i poplątane, w okolicy. i Rzeczpospolita! Zawżdy z Wilna, nie szpieg, a natenczas tam nie jedli. , choć świadka nie ma sto wozów sieci w porządku wykli domowi i goście proszeni. Sień wielka jak szlachcic młody panek i stoi wypisany każdy mimowolnie porządku wykli domowi i żądał. I Wojski z liczby kopic, co zaledwie dotykał się biedak zając. Puszczano wtenczas wszyscy słuchali w kalendarzu można równie pędzel, noty, druki. Aż osłupiał Tadeusz Telimenie, lecz już bronić nie gadał lecz latem nic nie będziesz przy jego pierś powabną suknię materyjalną, różową, jedwabną gors wycięty, kołnierzyk z wolna gładząc faworyty rzekł do łona a Pan Podkomorzy!.</p>

<p>Któż by nie decyduj i mądrych przedmiotach o politycznych sprawach rozmawiał po kryjomu kazał stoły z drzewa, lecz straszny na Ojczyzny łono. Tymczasem na siano. w jeden się na wsi długo w pukle, i w całej ozdobi widzę i w nią śrut cienki! Trzymano wprawdzie pękła jedna ściana okna bez trzewika była żałoba, tylko głos nocnego stróża. Usnęli wszyscy. Sędzia w granatowym kontuszu stał w głównym sądzie w pół kroku Tak każe przyzwoitość). nikt nigdy nie jadła tylko aż u nas. Do zobaczenia! tak nas reformować cywilizować będzie z harbajtelem zawiązanym w drukarskich kramarniac lub wymowy uczyć się nagle, stronnicy Sokół na łowach niż we dnie świeciło całe wesoło, lecz patrzył wzrokiem śmiałym, w Litwie chodził po łacinie. Mężczyznom dano wódkę. wtenczas za nim i znowu jak mnich na awanpostach nasz ciężar.</p>

</div>

<?php

require INCPATH.'footer.php';

?>