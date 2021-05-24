<?php
session_start();

include 'dbconnect.php';
$mydb = new myPDO();
if(!$mydb) {
    exit("Feil med forbindelse");
}

$bruker = $_SESSION['epost'];
$info = $_POST['informasjon'];
$trukket = $_POST['trukket'];

if(isset($_POST['oppdaterkandidatur'])) {

    $sql = "UPDATE kandidat SET informasjon = :info, trukket = :trukket \n"
    . "WHERE bruker = :bruker";
    $stm = $mydb -> prepare($sql);
    $stm -> bindParam(":info", $info);
    $stm -> bindParam(":trukket", $trukket);
    $stm -> bindParam(":bruker", $bruker);
    if($stm -> execute()) {
        setcookie("oppdatertkandidat", "Informasjon oppdatert", time()+3, "/");
    } else {
        setcookie("oppdatertkandidat", "Feil med oppdatering vennligst prøv igjen", time()+3, "/");
    }
    header("Location: ../myprofile.php");
}
?>