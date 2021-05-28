<?php
@session_start(['cookie_lifetime' => 86400,
'read_and_close'  => true,]);
// session_start();

// <!-- siden utvikelt av Raymond Dowling sist endret 03.mars 2021 -->
// <!-- siden endret av Serhat Bawer Guzel sist endtet 11.mai 2021 -->

if(isset($_SESSION['innlogget'])) {
    $innlogget = $_SESSION['innlogget']; 
} else {
    $innlogget = FALSE;
}
$title = "Valg 2021";

if(isset($_COOKIE['regmislykket'])) {
    $msg = $_COOKIE['regmislykket'];
    echo "<script>alert(\"$msg\"):</script>";
}

include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("Feil med forbindelse");
}

include 'php/header.php';

$sql = "SELECT startforslag, sluttforslag, startvalg, sluttvalg FROM valg";
$stm = $mydb -> prepare($sql);
$stm -> execute();
$list = $stm -> fetch(PDO::FETCH_ASSOC);

echo <<<MKR
<main>
<h1>$title</h1>
<table id="default">
    <tr>
        <th>Nominering Start</th>
        <th>Nominering Slutt</th>
        <th>Valg Start</th>
        <th>Valg Slutt</th>
    </tr>
    <tr>
		<td><span class="mobiltekst">Nominering Start</span> <strong>{$list['startforslag']}</strong></td>
		<td><span class="mobiltekst">Nominering Slutt</span> <strong>{$list['sluttforslag']}</strong></td>
		<td><span class="mobiltekst">Valg Start</span> <strong>{$list['startvalg']}</strong></td>
		<td><span class="mobiltekst">Valg Slutt</span> <strong>{$list['sluttvalg']}</strong></td>
	</tr>
<img class="dtpics" id="choicepick" src="images/choiceindex.jpg" alt="ubesluttsom mann" height="400" width="400">
</main>
MKR;

if (isset($_COOKIE['regmislykket'])) {
    echo "<p class=\"phpmelding\">" .$_COOKIE['regmislykket'] . "</p>";
}

include 'php/footer.php';
?>