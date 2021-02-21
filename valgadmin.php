<?php
session_start();

// siden utviklet av Raymond Dowling sist endret 18.feburar 2021
$innlogget = TRUE; // $_SESSION['innlogget'];

// ###### koble til databasen ###########
include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

$title = "Valg Adminstrasjon";
include 'php/header.php';


echo <<<MKR
<main>
<h2>$title</h2>
<!--
<label for="valgid">Valg ID: </label>
<select name="valgid" id="valgid">
-->
MKR;
// $sql = "SELECT idvalg,start-forslag,slutt-forslag,start-valg,slutt-valg,tittel FROM valg";  // ########## PROBLEM WITH START- IN NAMES
$sql = "SELECT * FROM valg";
$stm = $mydb -> prepare($sql);
$stm -> execute();
$result = $stm -> fetchAll(); // ####### LIMIT TRAFFIC - HAVE MINIMAL RESULTS ############
// print_r($result);
// vis i tabell så bruk js til å velge hva skal endres
echo "<table>
    <tr>
    <th>Valg id</th><th>Start forslag</th><th>Slutt forslag</th><th>Start Valg</th><th>Slutt Valg</th><th>Tittel</th><th>Endre?</th>
    </tr>";
$radnr = 0;
while ($radnr < $stm -> rowCount()) {
    $tr = "<tr class=\"rad$radnr\">";
    for ($col = 0; $col < 7; $col++) {
        $tr .= "<td>".$result[$radnr][$col]."</td>";
    }
    $tr .= "<td><input type=\"radio\" name=\"choice\" id=$radnr onclick=\"kopitr(id);\"></td>";
    $tr .= "</tr>";
    echo $tr;
    $radnr ++;
}
echo "</table>";

echo "<br>result of query<br>";
echo $result[0][6] . "**election in america<br><br>";


echo <<<MKR
</select>

<form name="valgdato" id="valgdato" action="php/valgdato.php" action="post"> <!-- target for melding & js for dato-sjekk -->
    <label for="start-forslag">Startdato for Nominering</label><br/>
    <input type="datetime" name="start-forslag" id="start-forslag">
    <label for="slutt-forslag">Sluttdato for Nominering</label>
    <input type="datetime" name="slutt-forslag" id="slutt-forslag">
    <label for="start-valg">Startdato for Valg</label>
    <input type="dattime" name="start-valg" id="start-valg">
    <label for="slutt-valg">Sluttdato for Valg</label>
    <input type="datetime" name="slutt-valg" id="slutt-valg">
    <input type="submit" value="endre">
</form>
</main>
MKR;
include 'php/footer.php';
?>


