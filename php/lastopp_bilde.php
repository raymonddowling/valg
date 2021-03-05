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
/* 
echo "Post " . var_dump($_POST) . "<br>";
echo "<br><br>";
echo "Files " . var_dump($_FILES) . "<br>";
 */
if ($_FILES['profilbilde']['error'] == 0) {
    // echo "no error ";
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
        var_dump($update);

        var_dump($ok1);
        var_dump($ok2);
        if(!$ok1 || !$ok2) {
            echo "Feil vennligst <a href= \"../myprofile.php\">prøve igjen</a>";
        } else {
            echo "Bilet er lastetopp - gå til <a href=\"../myprofile.php\">forrige siden</a>";
        }
    }     //else {        //update         $id = (int)$bildenr;     } ### Kun ett bilde er lov så kan bruke sammen navn, tekst og bilde id
    
    echo "Bilet er lastetopp - gå til <a href=\"../myprofile.php\">forrige siden</a>";
}

?>