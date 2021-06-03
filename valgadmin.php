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
MKR;

if(isset($_COOKIE['endretdato'])) {
    $msg = $_COOKIE['endretdato'];
    echo "<script>alert(\"$msg\");</script>";
    // echo "<p class=\"phpmelding\">" .$_COOKIE['endretdato']."</p>";
    // header("refresh: 5");
}

$sql = "SELECT tittel,startforslag,sluttforslag,startvalg,sluttvalg FROM valg LIMIT 1";  // ########## Oppdatert DB-Modell ett ord #### Skal være kun et valg i tabellen
$stm = $mydb -> prepare($sql);
$stm -> execute();
$result = $stm -> fetch(PDO::FETCH_ASSOC);

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
include 'php/footer.php';
?>


