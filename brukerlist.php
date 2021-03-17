<?php
session_start();

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
<table>
<tr>
<th>Epost</th><th>Navn</th><th>Stemme</th>
</tr>
MKR;

while ($resultat = $stm -> fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>".$resultat['epost']."</td> <td>".$resultat['navn']."</td> <td>".$resultat['stemme']."</td>";
    echo "</tr>";
}

echo <<<MKR
</table>
</main>
MKR;

include 'php/footer.php';
