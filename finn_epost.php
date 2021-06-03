<?php

function epost_funnet($epost, $title) {
    echo <<<MKR
    <main>
    <h1>$title</h1>
    <h2>Velg nytt passord for $epost</h2>
    <form action="php/nyttpassord.php" method="POST">
        <label for="password">Velg passord</label>
        <input type="password" placeholder="Skriv passord" name="password" id="password" required>
        <label for="passord2">Gjenta passordet</label>
        <input type="password" placeholder="Gjenta passordet" name="passord2" id="passord2" onblur="passordsjekk()" required>
        <input type="hidden" name="epost" value="{$epost}"/>
        <button type="submit" class="registerknapp" name="bekreft">Bekreft</button>
    </form>
    </main>
    MKR;
}

function epost_ikkefunnet() {
    echo <<<MKR
    <main>
    <h1>$title</h1>
    <p class="fremheve">Epostadressen er ikke funnet i vårt system</p>
    <p>Vennligst <a href="glemtpassord.html"> prøv igjen </a></p>
    </main>
    MKR;
}

include 'php/dbconnect.php';
$mydb = new mypdo();

if(!$mydb) {
    exit("Feil med forbindelse");
}

$innlogget = FALSE;
$title="Nytt Passord";
include 'php/header.php';

if(isset($_POST['sokmail'])) {
    $epost = $_POST['email'];
    $sql = "SELECT COUNT(epost) FROM bruker WHERE epost = :mail";
    $stm = $mydb -> prepare($sql);
    $stm -> bindParam(":mail", $epost);
    $stm -> execute();
    $res = $stm -> fetch(PDO::FETCH_NUM);
    if($res[0] == "1") {
        epost_funnet($epost, $title);
    } else {
        epost_ikkefunnet($title);
    }
    $stm -> closeCursor();
} else {
    header("Location: default.php");
}

include 'php/footer.php';

?>

