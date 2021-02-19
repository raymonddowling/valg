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
// include 'php/header.php';


echo <<<MKR
<main>
<h2>$title</h2>

<label for="vlagid">Valg ID: </label>
<select name="valgid" id="valgid">
MKR;
$sql = "SELECT idvalg FROM valg";
$stm = $mydb -> prepare($sql);
$res = $stm -> execute();
while ($rad = $stm -> fetch(PDO::FETCH_ASSOC)) {
    $linje = "<option value = ".$rad['idvalg'].">".$rad['idvalg']."</option>";
    echo $linje;
}

echo <<<MKR
</select>

<form name="valgdato" action="php/valgdato.php" action="post"> <!-- target for melding & js for dato-sjekk -->
    <label for="start-forslag">Startdato for Nominering</label><br/>
    <input type="date" name="start-forslag" id="start-forslag" value=>
    <label for="slutt-forslag">Sluttdato for Nominering</label>
    <input type="date" name="slutt-forslag" id="slutt-forslag">
    <label for="start-valg">Startdato for Valg</label>
    <input type="date" name="start-valg" id="start-valg">
    <label for="slutt-valg">Sluttdato for Valg</label>
    <input type="date" name="slutt-valg" id="slutt-valg">
    <input type="submit" value="endre">
</form>
</main>
MKR;
include 'php/footer.php';
?>
