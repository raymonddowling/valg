<?php
@session_start(['cookie_lifetime' => 86400,
'read_and_close'  => true,]);
// session_start();

// <!-- siden utvikelt av Raymond Dowling sist endret 03.mars 2021 -->
// <!-- siden endret av Serhat Bawer Guzel sist endtet 11.mai 2021 -->

$innlogget = $_SESSION['innlogget']; //$_SESSION['innlogget'] = TRUE;
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
<table>
    <tr>
        <td>Nominering Start</td>
        <td>Nominering Slutt</td>
        <td>Valg Start</td>
        <td>Valg Slutt</td>
    </tr>
    <tr>
		<td> {$list['startforslag']} </td>
		<td> {$list['sluttforslag']} </td>
		<td> {$list['startvalg']} </td>
		<td> {$list['sluttvalg']} </td>
	</tr>

</main>
MKR;

if (isset($_COOKIE['regmislykket'])) {
    echo "<p class=\"phpmelding\">" .$_COOKIE['regmislykket'] . "</p>";
}

include 'php/footer.php';
?>