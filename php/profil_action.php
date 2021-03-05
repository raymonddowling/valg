<?php
session_start();
// var_dump($_POST);

include 'dbconnect.php';
$mydb = new myPDO();
if(!$mydb) {
    exit("Feil med forbindelse");
}

$bruker = $_SESSION['epost'];
$info = $_POST['informasjon'];
$trukket = $_POST['trukket'];

$sql = "UPDATE kandidat SET informasjon = :info, trukket = :trukket \n"
    . "WHERE bruker = :bruker";
$stm = $mydb -> prepare($sql);
$stm -> bindParam(":info", $info);
$stm -> bindParam(":trukket", $trukket);
$stm -> bindParam(":bruker", $bruker);
if($stm -> execute()) {
    echo "Informasjon oppdatert";
} else {
    echo "Feil med oppdatering vennligst prøv igjen";
}
echo "<br/><a href = \"../myprofile.php\">Tilbake til forrige siden</a>";
?>