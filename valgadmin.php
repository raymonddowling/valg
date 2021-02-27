<?php
session_start();

// siden utviklet av Raymond Dowling sist endret 18.feburar 2021
$innlogget = $_SESSION['innlogget'];

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
$sql = "SELECT tittel,startforslag,sluttforslag,startvalg,sluttvalg FROM valg";  // ########## Oppdatert DB-Modell ett ord
// $sql = "SELECT * FROM valg";
$stm = $mydb -> prepare($sql);
$stm -> execute();
$result = $stm -> fetchAll(); // ####### LIMIT TRAFFIC - HAVE MINIMAL RESULTS ############
// print_r($result);
// vis i tabell så bruk js til å velge hva skal endres
echo "<table>
    <tr>
    <th>Tittel</th><th>Start forslag</th><th>Slutt forslag</th><th>Start Valg</th><th>Slutt Valg</th><th>Endre?</th>
    </tr>";
$radnr = 0;
while ($radnr < $stm -> rowCount()) {
    $tr = "<tr class=\"rad$radnr\">";
    for ($col = 0; $col < 5; $col++) {
        $tr .= "<td>".$result[$radnr][$col]."</td>";
    }
    $tr .= "<td><input type=\"radio\" name=\"choice\" id=$radnr onclick=\"kopitr(id);\"></td>";
    $tr .= "</tr>";
    echo $tr;
    $radnr ++;
}
// echo "<tr><td colspan=\"6\">";
// echo "</td></tr>";
echo "</table>";
echo "<input type=\"button\" class=\"registerknapp1\" value=\"Nytt Valg\" onclick=\"visValgform(2,3);\">";

echo <<<MKR
</select>
<h3 class="valgform">Endre datoene</h3>
<form name="valgdato" id="valgdato" action="php/valgdato.php" method="POST" enctype=”text/plain” class="valgform"> <!-- target for melding & js for dato-sjekk -->
    <label for="startforslag">Startdato for Nominering</label>
    <input type="datetime" name="startforslag" id="startforslag" placeholder="yyyy-mm-dd hh:mm:ss">
    <label for="sluttforslag">Sluttdato for Nominering</label>
    <input type="datetime" name="sluttforslag" id="sluttforslag" placeholder="yyyy-mm-dd hh:mm:ss">
    <label for="startvalg">Startdato for Valg</label>
    <input type="datetime" name="startvalg" id="startvalg" placeholder="yyyy-mm-dd hh:mm:ss">
    <label for="sluttvalg">Sluttdato for Valg</label>
    <input type="datetime" name="sluttvalg" id="sluttvalg" placeholder="yyyy-mm-dd hh:mm:ss">
    <input type="submit" value="Endre" name="endre" class="registerknapp1">
</form>

<h3 class="valgform">Legg till Nytt Valg</h3>
<form name="nyvalg" id="nyvalgdato" action="php/valgdato.php" method="POST" enctype=”text/plain” class="valgform"> <!-- target for melding & js for dato-sjekk -->
    <label for="tittel">Tittel</label>
    <input type="text" name="tittel" id="tittel" placeholder="Valg tittel">
    <label for="startforslag">Startdato for Nominering</label>
    <input type="datetime" name="startforslag" id="startforslag" placeholder="yyyy-mm-dd hh:mm:ss">
    <label for="sluttforslag">Sluttdato for Nominering</label>
    <input type="datetime" name="sluttforslag" id="sluttforslag" placeholder="yyyy-mm-dd hh:mm:ss">
    <label for="startvalg">Startdato for Valg</label>
    <input type="datetime" name="startvalg" id="startvalg" placeholder="yyyy-mm-dd hh:mm:ss">
    <label for="sluttvalg">Sluttdato for Valg</label>
    <input type="datetime" name="sluttvalg" id="sluttvalg" placeholder="yyyy-mm-dd hh:mm:ss">
    <input type="submit" value="Register" name="register"class="registerknapp1">
</form>
</main>
MKR;
include 'php/footer.php'; //footer height 70px
?>


