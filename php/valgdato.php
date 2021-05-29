<?php
session_start();

// Siden utviklet av Raymond Dowling sist endret 21.februar 2021
// Siden utviklet av Raymond Dowling sist endret 28.mai 2021

// Register / Endre datoer for valg og / eller nominsajon

$brukertype = $_SESSION['brukertype'];

function writeHtml($startforslag, $sluttforslag, $startvalg, $sluttvalg) {
    $fil = fopen("../txt/valg_opplysning.html", "w");
    $header = file_get_contents ("../txt/header.txt");
    $footer = file_get_contents ("../txt/footer.txt");
    $main = "<main>
    <h1>Valg 2021</h1>
    <table>
        <tr>
            <th>Nominering Start</th>
            <th>Nominering Slutt</th>
            <th>Valg Start</th>
            <th>Valg Slutt</th>
        </tr>
        <tr>
            <td><span class=\"mobiltekst\">Nominering Start</span> <strong>$startforslag</strong></td>
            <td><span class=\"mobiltekst\">Nominering Slutt</span> <strong>$sluttforslag</strong></td>
            <td><span class=\"mobiltekst\">Valg Start</span> <strong>$startvalg</strong></td>
            <td><span class=\"mobiltekst\">Valg Slutt</span> <strong>$sluttvalg</strong></td>
        </tr>
    </table>
    </main>\n";

    fwrite($fil, $header."\n");
    fwrite($fil, $main."\n");
    fwrite($fil, $footer);
    fclose($fil);

}

if($brukertype != 2) { //kun administatør skal har tilgang
    header("Location: ../default.php");
    exit("Ikke tillat");
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

?>