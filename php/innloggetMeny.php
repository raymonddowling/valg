<?php
// Siden utviklet av Raymond Dowling sist endret 10.desember 2020
// Siden utviklet av Raymond Dowling sist endret 05.februar 2021

$name = $_SESSION['navn'];
$kandidat = $_SESSION['kandidat'];
$brukertype = $_SESSION['brukertype'];
$nomineringsperiode = $_SESSION['nomineringsperiode'];
$valgperiode = $_SESSION['valgperiode'];

function brukerMeny() {
	// meny for innlogget vanligbruker og ekstra hvis brukeren er kandidat
	
	echo <<<MKR
	<a href="default.php""> <img class="dtpics" src="images/election.png" alt="valgurne" height="100" width="130"> </a>
	<button id="hamburgermeny" onclick=toggleMenu()>MENY</button>
	<ul id="menuitems">
	<li id="home"><a href="default.php">Home</a></li>
	<li><a href="txt/valg_opplysning.html">Valg Opplysning</a></li>
	<li><a href="byttpassord.php">Bytt passord</a></li>
	MKR;
	if($GLOBALS['nomineringsperiode']) { echo "<li><a href=\"nominering.php\">Nominering</a></li>";	}
	if($GLOBALS['valgperiode']) { echo "<li><a href=\"avstemning.php\">Avstemning</a></li>";}
	if($GLOBALS['kandidat']) { echo "<li><a href=\"myprofile.php\">Kandidatur</a></li>";	}
}

function adminMeny() {
	echo '<li><a href="valgadmin.php">Administere Valget</a></li>';
	echo '<li><a href="adminpermission.php">Administere Roller</a></li>';
}

function kontrollerMeny() {
	echo '<li><a href="brukerlist.php">Kontroll Epost domene</a></li>';
	echo '<li><a href="kontroll_avstemning.php">Kontroll Avstemning</a></li>';

}

brukerMeny();
if ($brukertype == 2) {
	adminMeny();
}
if ($brukertype == 3) {
	kontrollerMeny();
}

echo "</ul> \n
	<a href=\"php/loggut.php\" class=\"logginnBtn\">Logg ut  " .$name."</a>";

?>