<?php
// Siden utviklet av Raymond Dowling sist endret 21.februar 2021

// Register / Endre datoer for valg og eller nominsajon

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
    // echo 'Endre';
    $update = "UPDATE valg SET startforslag = :stf, sluttforslag = :slf, startvalg = :stv, sluttvalg = :slv";
    $stm = $mydb -> prepare($update);
    $stm -> bindParam(":stf", $startforslag, PDO::PARAM_STR);
    $stm -> bindParam(":slf", $sluttforslag, PDO::PARAM_STR);
    $stm -> bindParam(":stv", $startvalg, PDO::PARAM_STR);
    $stm -> bindParam(":slv", $sluttvalg, PDO::PARAM_STR);
    $stm -> execute();
    $stm -> closeCursor();
    // var_dump($sluttvalg);
    echo "Endring vellykket <a href = \"../valgadmin.php\">Tilbake til forrige siden</a>";
}

if (isset($_POST['register'])) {
    $tittel = $_POST['tittel'];
    echo 'Register';
    $reg = "INSERT INTO valg (tittel, startforslag, sluttforslag, startvalg, sluttvalg) VALUES (:tit, :stf, :slf, :stv, :slv)";
    $stm = $mydb -> prepare($reg);
    $stm -> bindParam(":tit", $tittel);
    $stm -> bindParam(":stf", $startforslag);
    $stm -> bindParam(":slf", $sluttforslag);
    $stm -> bindParam(":stv", $startvlag);
    $stm -> bindParam(":slv", $sluttvlag);
    $stm -> execute();
    $stm -> closeCursor();
}

?>