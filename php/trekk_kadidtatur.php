<?php
session_start();

include 'db_connect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

$epost = $_SESSION['epost'];

$sql = "DELETE FROM kandidat WHERE bruker = :epost";
$statement = $mydb -> prepare($sql);
$statement -> bindParam(":epost", $epost);
$statement -> execute();

?>