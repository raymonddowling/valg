<?php
session_start();

// siden utvikelt av Raymond Dowling sist endret 23.mai 20201

include 'dbconnect.php'; 
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

if (isset($_POST['stem'])) {
    $valgt_kandidat = $_POST['kandidat_stemt'];
    $stemmeberettige = $_SESSION['epost']; //innlogget brukeren

    $sql = "UPDATE kandidat SET stemmer = stemmer + 1 WHERE bruker = :vk";
    $stm = $mydb -> prepare($sql);
    $stm -> bindParam(":vk", $valgt_kandidat);
    $stm -> execute();

    $sql1 = "UPDATE bruker SET stemme = :kandidat WHERE epost = :innlogget";
    $stm1 = $mydb -> prepare($sql1);
    $stm1 -> bindParam(":kandidat", $valgt_kandidat);
    $stm1 -> bindParam(":innlogget", $stemmeberettige);
    $stm1 -> execute();

    $_SESSION['har_stemt'] = TRUE;

    header("Location: ../avstemning.php");
}

?>



















