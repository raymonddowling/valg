<?php
session_start();

// siden utviklet av Raymond Dowling sist endret 18.feburar 2021
$innlogget = $_SESSION['innlogget'];
$brukertype = $_SESSION['brukertype'];

if(!$innlogget || $brukertype != 2) { // hvis brukeren er ikke innlogget som admin
    header("Location: default.php"); // send til hjem.
}

// ###### koble til databasen ###########
include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}
// $visMeny = true;
$title = "Valg Administrasjon";
include 'php/header.php';


echo <<<MKR
<main>
<h1>$title</h1>
<!--
<label for="valgid">Valg ID: </label>
<select name="valgid" id="valgid">
-->
MKR;
$sql = "SELECT tittel,startforslag,sluttforslag,startvalg,sluttvalg FROM valg LIMIT 1";  // ########## Oppdatert DB-Modell ett ord #### Skal være kun et valg i tabellen
$stm = $mydb -> prepare($sql);
$stm -> execute();
$result = $stm -> fetch(PDO::FETCH_ASSOC);
//$result = $stm -> fetchAll(); // ####### LIMIT TRAFFIC - HAVE MINIMAL RESULTS FOR TABLE ############
/* echo "<table> //######### FJERN TABEL #######################
    <tr>
    <th>Tittel</th><th>Start forslag</th><th>Slutt forslag</th><th>Start Valg</th><th>Slutt Valg</th>
    </tr>";
$radnr = 0;
while ($radnr < $stm -> rowCount()) {
    $tr = "<tr>";
    for ($col = 0; $col < 5; $col++) {
        $tr .= "<td>".$result[$radnr][$col]."</td>";
    }
    // $tr .= "<td><input type=\"radio\" name=\"choice\" id=$radnr onclick=\"kopitr(id);\"></td>";
    $tr .= "</tr>";
    echo $tr;
    $radnr ++;
} */
// echo "<tr><td colspan=\"6\">";
// echo "</td></tr>";
//echo "</table>";
// echo "<input type=\"button\" class=\"registerknapp1\" value=\"Nytt Valg\" onclick=\"visValgform(2,3);\">";  ######## kun 1 valg ########
if(isset($_COOKIE['endretdato'])) {
    echo "<p class=\"phpmelding\">" .$_COOKIE['endretdato']."</p>";
    header("refresh: 5");
}
echo <<<MKR
</select>
<h2 class="valgform">Endre datoene</h2>
<form name="valgdato" id="valgdato" action="php/valgdato.php" method="POST" enctype=”text/plain” class="valgform" onsubmit="return sjekkDatoene();"> <!-- target for melding & js for dato-sjekk -->
    <label for="startforslag">Startdato for Nominering</label>
    <input type="datetime" name="startforslag" id="startforslag" placeholder="yyyy-mm-dd hh:mm:ss" value={$result['startforslag']}>
    <label for="sluttforslag">Sluttdato for Nominering</label>
    <input type="datetime" name="sluttforslag" id="sluttforslag" placeholder="yyyy-mm-dd hh:mm:ss" value={$result['sluttforslag']}>
    <label for="startvalg">Startdato for Valg</label>
    <input type="datetime" name="startvalg" id="startvalg" placeholder="yyyy-mm-dd hh:mm:ss" value={$result['startvalg']}>
    <label for="sluttvalg">Sluttdato for Valg</label>
    <input type="datetime" name="sluttvalg" id="sluttvalg" placeholder="yyyy-mm-dd hh:mm:ss" value={$result['sluttvalg']}>
    <button type="submit" value="Endre" name="endre" class="registerknapp">Endre</button>
</form>


</main>
MKR;
include 'php/footer.php'; //footer height 70px
?>


