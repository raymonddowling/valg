<?php
session_start();

// <!-- siden utviklet av Arientim Sopa sist endret 16.oktober 2020-->
// siden utivklet av Raymond Dowling sist endret 22.mai 2021

function har_stemt() {
	echo <<<MKR
	<form action="" id="avgistemme" name="avgistemme" method="POST">
	MKR;
	
	$sql = "SELECT bruker, CONCAT(enavn, \" \" , fnavn) AS fultnavn FROM kandidat, bruker WHERE kandidat.bruker = bruker.epost";
	$stm = $GLOBALS['mydb'] -> prepare($sql);
	$res = $stm -> execute();
	
	while ($row = $stm -> fetch(PDO::FETCH_ASSOC)) {
		echo "<label for=\"kandidat\">{$row['fultnavn']}</label>";
	}
	
	echo "</form>";
	echo "<p class=\"fremheve\">Din stemme er reigistert</p>";
}

function ikke_stemt() {
	echo <<<MKR
	<legend>Hvem har du lust å stemme på i år?</legend>
	<form action="php/avgistemme.php" id="avgistemme" name="avgistemme" method="POST">
	MKR;

	$sql = "SELECT bruker, CONCAT(enavn, \" \" , fnavn) AS fultnavn FROM kandidat, bruker WHERE kandidat.bruker = bruker.epost";
	$stm = $GLOBALS['mydb'] -> prepare($sql);
	$res = $stm -> execute();

	while ($row = $stm -> fetch(PDO::FETCH_ASSOC)) {
		echo "<label for=\"kandidat\">{$row['fultnavn']}</label>";
		echo "<input type=\"radio\" name=\"kandidat_stemt\" value=\"" . $row['bruker'] . "\">";
	}

	echo <<<MKR
	<button type="submit" class="registerknapp" name="stem">Stem</button>

	</form>
	MKR;

}

$innlogget = $_SESSION['innlogget'];
$valgperiode = $_SESSION['valgperiode'];
$har_stemt = $_SESSION['har_stemt'];
$title = "Avstemning";

if(!$innlogget || !$valgperiode) { // kun inlogget bruker kan stemme under git valgperioden
	header("Location: default.php");
	exit("Acess deinied!");
}

include 'php/dbconnect.php'; 
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

include "php/header.php";

echo <<<MKR
<main>
<h1>$title</h1>
<h2>Kandidater</h2>
MKR;

if($har_stemt) {
	har_stemt();
} else {
	ikke_stemt();
}
	
echo "</main>";

include 'php/footer.php';

?>
