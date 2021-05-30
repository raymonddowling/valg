<?php
// Siden utviklet av Raymond Dowling sist endret 10.desember 2020
// Siden utviklet av Raymond Dowling sist endret 29.mai 2021

function brukerMeny($ettervalget) {
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
	if($ettervalget) { echo "<li><a href=\"resultatside.php\">Valg Resultat</a></li>";}
	
}

function adminMeny($ettervalget) {
	echo '<li><a href="valgadmin.php">Administere Valget</a></li>';
	echo '<li><a href="adminpermission.php">Administere Roller</a></li>';
	if(!$ettervalget) { echo "<li><a href=\"resultatside.php\">Valg Resultat</a></li>";} // vises for alle bruker etter valget
	
}

function kontrollerMeny($ettervalget) {
	echo '<li><a href="brukerlist.php">Kontroll Epost domene</a></li>';
	echo '<li><a href="kontroll_avstemning.php">Kontroll Avstemning</a></li>';
	if(!$ettervalget) { echo "<li><a href=\"resultatside.php\">Valg Resultat</a></li>";} // vises for alle bruker etter valget
	
}

function valgKontrollert() {
    /* test om valget har blitt kontrollert */
    
	$sql = "SELECT sluttvalg, kontrollert FROM valg";
    $stm = $GLOBALS['mydb'] -> prepare($sql);
    $stm -> execute();
    $res = $stm -> fetch(PDO::FETCH_NUM);

    if($res[0] < $res[1]) { 
        return TRUE;
    } else {
        return FALSE;
    }
}

$name = $_SESSION['navn'];
$kandidat = $_SESSION['kandidat'];
$brukertype = $_SESSION['brukertype'];
$nomineringsperiode = $_SESSION['nomineringsperiode'];
$valgperiode = $_SESSION['valgperiode'];

$ettervalget = valgKontrollert();

brukerMeny($ettervalget);
if ($brukertype == 2) {
	adminMeny($ettervalget);
}
if ($brukertype == 3) {
	kontrollerMeny($ettervalget);
}

echo "</ul> \n
	<a href=\"php/loggut.php\" class=\"logginnBtn\">Logg ut  " .$name."</a>";

?>