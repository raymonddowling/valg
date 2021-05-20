<?php
session_start();

include 'dbconnect.php'; 
$mydb = new mypdo();

if(!$mydb) { 
    exit('somthing went wrong');
}

if (isset($_POST['register'])) {
    $epost = $_POST["email"];
    $pord = $_POST["password"];
    $enavn = $_POST["etternavn"];
    $fnavn = $_POST["fornavn"];
    $brukertype = 1;

    $salt = "IT2_2021";

    $passord = sha1($salt.$pord);

    // prepare statement
    $stmt = $mydb->prepare('INSERT INTO bruker (epost, passord, enavn, fnavn, brukertype) VALUES (?, ?, ?,?, ?)');
    // bind paramaters
    $stmt->bindParam(1, $epost, PDO::PARAM_STR);
    $stmt->bindParam(2, $passord, PDO::PARAM_STR);
    $stmt->bindParam(3, $enavn, PDO::PARAM_STR);
    $stmt->bindParam(4, $fnavn, PDO::PARAM_STR);
    $stmt->bindParam(5, $brukertype, PDO::PARAM_INT);

    $lykkes = $stmt->execute();

}
if($lykkes) {
    // echo "<script>alert(\"Registering vellykket\")</script>";
    setcookie("regmislykket", "Registering vellykket", time()+3, "/");
    header("Location: innlogging_sjekk.php?reg=1&pord=".$pord."&epost=".$epost . SID); //prøv innlogginsjekk fo å sette opp meny
} else {
    setcookie("regmislykket", "Det oppstår feil med registering\nVennligst prøv igjen senere", time()+3, "/");
    header("Location: ../default.php" .SID);
} 

?>