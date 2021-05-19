<?php

// Siden utviklet av Raymond Dowling sist endret 21.februar 2021
// Siden utviklet av Raymond Dowling sist endret 12.mai 2021

// Register / Endre datoer for valg og / eller nominsajon

function writeHtml($startforslag, $sluttforslag, $startvalg, $sluttvalg) {
    $innervar = "My name";
    $header = file_get_contents ("../txt/header.txt");
    $footer = file_get_contents ("../txt/footer.txt");
    $main = "<main>
    <h1>Valg 2021</h1>
<table>
    <tr>
        <td>Nominering Start</td>
        <td>Nominering Slutt/td>
        <td>Valg Start</td>
        <td>Valg Slutt</td>
    </tr>
    <tr>
		<td>$startforslag</td>
		<td>$sluttforslag</td>
		<td>$startvalg</td>
		<td>$sluttvalg</td>
	</tr>
</table>
    </main>";

    $fil = fopen("taimot.html", "w");
    fwrite($fil, $header."\n");
    fwrite($fil, $main."\n");
    fwrite($fil, $footer);
    fclose($fil);

}

include 'dbconnect.php';
$mydb = new myPDO();
if (!$mydb) {
    exit("feil med forbindelse");
}

$startforslag = $_POST['startforslag'];
$sluttforslag = $_POST['sluttforslag'];
$startvalg = $_POST['startvalg'];
$sluttvalg = $_POST['sluttvalg'];


if (isset($_POST['endre'])) {
    $update = "UPDATE valg SET startforslag = :stf, sluttforslag = :slf, startvalg = :stv, sluttvalg = :slv";
    $stm = $mydb -> prepare($update);
    $stm -> bindParam(":stf", $startforslag, PDO::PARAM_STR);
    $stm -> bindParam(":slf", $sluttforslag, PDO::PARAM_STR);
    $stm -> bindParam(":stv", $startvalg, PDO::PARAM_STR);
    $stm -> bindParam(":slv", $sluttvalg, PDO::PARAM_STR);
    $stm -> execute();
    $stm -> closeCursor();
    writeHtml($startforslag, $sluttforslag, $startvalg, $sluttvalg);
    setcookie("endretdato", "Endringen vellykket", time()+3, "/");
    header("Location: ../valgadmin.php");
}

include 'footer.php';
?>