<?php
session_start();
$innlogget = $_SESSION['innlogget'];
$brukertype = $_SESSION['brukertype'];

if(!$innlogget || $brukertype != 3) { // hvis brukeren er ikke innlogget som kontrollør
    header("Location: default.php"); // send til hjem.
}

include 'php/dbconnect.php';
$mydb = new myPDO();
if(!$mydb) {
    exit("Feil med forbindelse");
}

$sql = "SELECT epost, CONCAT(fnavn, \" \" , enavn) AS navn, stemme\n"
    . "FROM bruker\n"
    . "WHERE RIGHT(epost, 6) NOT LIKE \"usn.no\"";

$stm = $mydb -> prepare($sql);
$stm -> execute();

$title = "Bruker list";
include 'php/header.php';

echo <<<MKR
<main>
<h1>Bruker List</h1>
<h2>Brukerne som ikke er registret med USN domene</h2>


<div class="flextabell">
<div class="flextabelltop">Epost Adresse</div>
<div class="flextabelltop">Navn</div>
<div class="flextabelltop">Total Stemmer</div>

MKR;

while ($resultat = $stm -> fetch(PDO::FETCH_ASSOC)) {
    echo "<div class=\"epostadresse\">". $resultat['epost'] . "</div> <div class=\"navn\">". $resultat['navn']. "</div> <div class=\"stemme\"><span class = \"totalstemmer\">Total Stemmer: </span><strong>" . $resultat['stemme'] . "</strong></div>";
    // echo "<div class=\"rowbreak\"><br/></div>";
}
echo "</div>"."</main>";

/* echo <<<MKR

<div class="flextabell">
    <div class="epostadresse">
        epost adresse
    </div>
    <div class="navn">
        navn
    </div>
    <div class="stemme">
        stemme
    </div>
    <div class="rowbreak"> </div>
    <div class="epostadresse">
        Looooooooooong   epost adresse
    </div>
    <div class="navn">  
        navn
    </div>
    <div class="stemme">
        stemme <strong>-1</strong>  
    </div>

</div>

</main>
MKR; */

include 'php/footer.php';
