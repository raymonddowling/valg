<?php
session_start();

// siden utviklet av Serhat Bawer Guzel sist endret 21.mai 2021

/* ## Siden utviklet av Raymond Dowling sist endret 28.mai 2021 ### 
  ### Kun admin og kontroller kan se sidnen för valget ##### */

$innlogget = $_SESSION['innlogget'];
$title = "Resultat av Valg 2021";

include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("Feil med forbindelse");
}

include 'php/header.php';

$sql = "SELECT CONCAT(enavn, \" \", fnavn) as fultnavn, stemmer FROM kandidat INNER JOIN bruker ON bruker.epost = kandidat.bruker ORDER BY stemmer DESC";
$stm = $mydb -> prepare($sql);
$stm -> execute();

echo <<<MKR
<main>
<h1>$title</h1>
<table>
    <tr>
        <th>Navn</th>
        <th>Antall Stemmer</th>
    </tr>
MKR;
while ($list = $stm -> fetch(PDO::FETCH_ASSOC)) {
    $linje = "<tr>\n"
		   . "<td class=\"epostadresse\">{$list['fultnavn']}</td>\n"
		   . "<td class=\"stemt\"><span class=\"mobiltekst\">Antall Stemmer </span> <strong>{$list['stemmer']}</strong></td>"
           . "</tr>";
    echo $linje;
}

echo "</main>\n";

include 'php/footer.php';
?>