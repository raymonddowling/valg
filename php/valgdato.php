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
    echo 'Endre';
    $update = "UPDATE valg SET startforslag = :stf, sluttforslag = :slf, startvalg = :stv, sluttvalg = :slv";
    $stm = $mydb -> prepare($update);
    $stm -> bindParam(":stf", $startforslag);
    $stm -> bindParam(":slf", $sluttforslag);
    $stm -> bindParam(":stv", $startforslag);
    $stm -> bindParam(":slv", $sluttforslag);
    $stm -> execute();
    
}

if (isset($_POST['register'])) {
    $tittel = $_POST['tittel'];
    echo 'Register';
    $reg = "INSERT INTO valg (tittel, startforslag, sluttforslag, startvalg, sluttvalg) VALUES (:tit, :stf, :slf, :stv, :slv)";
    $stm = $mydb -> prepare($reg);
    $stm -> bindParam(":tit", $tittel);
    $stm -> bindParam(":stf", $startforslag);
    $stm -> bindParam(":slf", $sluttforslag);
    $stm -> bindParam(":stv", $startforslag);
    $stm -> bindParam(":slv", $sluttforslag);
    $stm -> execute();
}

?>