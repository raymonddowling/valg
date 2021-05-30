<?php

include 'dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("Feil med forbindelse");
}

if(isset($_POST['validere'])) { /* register validering */
    $sql = "UPDATE valg SET kontrollert = NOW()";
    if($mydb -> query($sql)) {
        setcookie("avsteming_valid", "Kontroll registrert", time()+3, "/");
        header("Location: ../kontroll_avstemning.php");
    } else {
        setcookie("avsteming_valid", "Feil med registerting\nVennligst prøv igjen senere", time()+3, "/");
        header("Location: ../kontroll_avstemning.php");
    }

} else {
    header("Location: ../default.php");
}

?>