<?php
session_start();

// siden utvilklet av Raymond Dowling sist endret 4.mars 2021

$innlogget = $_SESSION['innlogget'];
$epost = $_SESSION['epost'];
$fulltnavn = $_SESSION['navn'];

include 'dbconnect.php'; 

$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

$bildenr = $_POST['bildeid'];
if ($_FILES['profilbilde']['error'] == 0) { //ingen error med opplasting
    $bildenavn = str_replace(["@", "."], "_",$epost); //Erstatter @ og . fra epost address med underscore
    $bildenavn .= ".jpg";
    move_uploaded_file($_FILES['profilbilde']['tmp_name'], "../profilbilder/$bildenavn");

    //Oppdatere databasen
    if ($bildenr == "0") {
        //Insert setning
        $hvor = "profilbilder/" . $bildenavn;
        $tekst = "Kandidat til valget: " . $fulltnavn . "\nEpost: " . $epost;
        $alt = "Kandidat " . $fulltnavn;
        $insert = "INSERT INTO bilde (hvor, tekst, alt) VALUES (\"$hvor\", \"$tekst\", \"$alt\")"; //idbilde = A.I???
        $ok1 = $mydb -> query($insert);

        $lstid = $mydb -> lastInsertId(); //bruk i kandidat
        $update = "UPDATE kandidat SET bilde = $lstid WHERE bruker = \"$epost\"";
        $ok2 = $mydb -> query($update);
        
        if(!$ok1 || !$ok2) {
            setcookie("bildeopplasting", "Feil med opplasting \nvennligst prøv igjen", time()+3, "/");
        } else {
            setcookie("bildeopplasting", "Bildeopplasting vellykket", time()+3, "/");
        }
    
    header("Location: ../myprofile.php");
} else {
    setcookie("bildeopplasting", "Ingen bilde valgt", time()+3, "/");
    header("Location: ../myprofile.php");
}
?>