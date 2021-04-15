<?php
session_start();
/* 
?>

<!DOCTYPE html>
<!-- siden utvikelt av Raymond Dowling sist endret 09.desember 2020 -->

<html lang="no">

<head>
<meta charset ="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Valgsystem</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/hamburger.js"></script>
</head>

<body>

<?php
 */
include 'dbconnect.php'; 
$mydb = new mypdo();

if(!$mydb) { 
    exit('somthing went wrong');
}

if (isset($_POST['register'])) {
    echo "button pressed <br/>";
    var_dump($_POST);

    $epost = $_POST["email"];
    $pord = $_POST["passord1"];
    $enavn = $_POST["etternavn"];
    $fnavn = $_POST["fornavn"];
    $brukertype = 1;

    $salt = "IT2_2021";

    $passord = sha1($salt.$pord);

    // prepare statement
    $stmt = $mydb->prepare('INSERT INTO bruker (epost, passord, enavn, fnavn, brukertype) VALUES (?, ?, ?,?, ?)');
    // $stmt->bind_param($epost, $passord, $enavn, $fnavn, 1);
    // bind paramaters
    $stmt->bindParam(1, $epost, PDO::PARAM_STR);
    $stmt->bindParam(2, $passord, PDO::PARAM_STR);
    $stmt->bindParam(3, $enavn, PDO::PARAM_STR);
    $stmt->bindParam(4, $fnavn, PDO::PARAM_STR);
    $stmt->bindParam(5, $brukertype, PDO::PARAM_INT);

    $lykkes = $stmt->execute();

    // var_dump($lykkes);

}
if($lykkes) {
    echo "<script>alert(\"Registering vellykket\")</script>";
   /*  $_SESSION['navn'] = $epost;
    $_SESSION['innlogget'] = TRUE;
    $_SESSION['bruketype'] = $brukertype;
    $_SESSION[''] */
   // header("Location: ../avstemning.php?".SID);
   
   header("Location: ../logginn.html"); //send til logginn sida for å få dynamisk meny
} else {
    echo "<br/>Reg mislykket";
    echo "<script>alert(\"Registering mislykket\")</script>";
    // header("Location: ../index.html");
} 
?>

<!-- </main>

</body>

</html>
 -->