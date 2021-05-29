<?php
session_start();

/* ### Siden utviklet av Raymond Dowling sist endret 28.mai 20201 ###### */


$innlogget = $_SESSION['innlogget'];
$brukertype = $_SESSION['brukertype'];

if(!$innlogget || $brukertype != 3) { // hvis brukeren er ikke innlogget som kontrollør
    header("Location: default.php"); // send til hjem.
    exit("Ikke tillat");
}

include 'php/dbconnect.php';
$mydb = new myPDO();
if(!$mydb) {
    exit("Feil med forbindelse");
}
$sql = "SELECT epost, CONCAT(enavn, \" \" , fnavn) AS navn, stemme, stemmer\n"
    . "FROM bruker LEFT OUTER JOIN kandidat\n"
    . "ON bruker.epost = kandidat.bruker\n"
    . "WHERE RIGHT(epost, 6) NOT LIKE \"usn.no\""
    . "ORDER BY enavn";

$stm = $mydb -> prepare($sql);
$stm -> execute();

$title = "Bruker list";
include 'php/header.php';

echo <<<MKR
<main>
<h1>$title</h1>
<h2>Brukerne som ikke er registret med USN domene</h2>


<table class="flextabell">
<tr>
<th class="flextabelltop">Epost Adresse</th>
<th class="flextabelltop">Navn</th>
<th class="flextabelltop">Total Stemmer</th>
<th class="flextabelltop">Avgitt Stemmer</th>
</tr>

MKR;

while ($resultat = $stm -> fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>\n<td class=\"epostadresse\">". $resultat['epost'] . "</td> <td class=\"navn\">". $resultat['navn']. "</td> <td class=\"stemmer\"><span class=\"mobiltekst\">Total Stemmer: </span><strong>" . $resultat['stemmer'] . "</strong></td> </td> <td class=\"stemmt\"><span class=\"mobiltekst\">Stemte: </span><strong>" . $resultat['stemme'] . "</strong></td> </tr>\n";
}
echo "</table>"."</main>";

include 'php/footer.php';
