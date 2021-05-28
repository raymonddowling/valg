<?php
session_start();

include 'dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("Feil med forbindelse");
}
if(isset($_POST['bekreft'])) {
    $epost = $_POST['epost'];
    $pord = $_POST['password'];

    $salt = "IT2_2021";
    $passord = sha1($salt.$pord);

    $sql = "UPDATE bruker SET passord = :ps WHERE epost = :ep";
    $stm = $mydb -> prepare($sql);
    $stm -> bindParam(":ps", $passord);
    $stm -> bindParam(":ep", $epost);
    $ok = $stm -> execute();

    if($stm -> rowCount() == 1) {
        setcookie("regmislykket", "Passordet er endret", time()+3, "/");
        header("Location: innlogging_sjekk.php?reg=1&pord=".$pord."&epost=".$epost . SID);
    } else {
        setcookie("regmislykket", "Det oppstår feil med å sette et nytt passord\nVennligst prøv igjen senere", time()+3, "/");
        header("Location: ../default.php" .SID);
    }
} else {
    header("Location: default.php");//ikke tilatte tilgang
}
