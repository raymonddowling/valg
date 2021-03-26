<?php
session_start();

// siden utvilklet av Raymond Dowling sist endret 25.mars 2021


function redigerbar_forms($fulltnavn, $info, $trukket, $bildeid) {
    echo <<<MKR
    <form name="editprofile" action="php/profil_action.php" method="post">
    <label for="navn">Navn</label>
    <input type="text" name="navn" value="{$fulltnavn}" readonly>
    <label for="informasjon">Rediger din informasjon</label>
    <textarea name="informasjon" rows="5" cols="40" placeholder="Informasjon om ditt kandidatur">$info</textarea>
    <label for="trukket">Alvslå ditt kandidatur</label>
    <input type="hidden" name="trukket" value="0">
    MKR;
    if ($trukket == "1") { 
        echo "<input type=\"checkbox\" name=\"trukket\" value=\"1\" checked>";
    } else {
        echo "<input type=\"checkbox\" name=\"trukket\" value=\"1\">";
    }
    echo <<<MKR
    <input type="submit" name="oppdaterkandidatur" value="Oppdater kadidatur" class="registerknapp1">
    </form>
    </section>
    
    <section>
    <h3>Lastopp Bilde</h3>
    <form name="lastoppbilde" id="lastoppbilde" action="php/lastopp_bilde.php" method="post" enctype="multipart/form-data">
    <label for="profilbilde">Lastopp et profilbilde</label>
    <input type="file" name="profilbilde">
    <input type="hidden" name="bildeid" value="$bildeid">
    <input type="submit" value="last opp bilde" name="lastopp" class="registerknapp1">
    </form>
    <section>
    MKR;
}

function lesing_forms($fulltnavn, $info, $trukket) {
    // fjern muligheter for endring av informasjonen og fjern "submit"-knapper
    echo <<<MKR
    <form name="editprofile" action="php/profil_action.php" method="post">
    <label for="navn">Navn</label>
    <input type="text" name="navn" value="{$fulltnavn}" readonly>
    <label for="informasjon">Rediger din informasjon</label>
    <textarea name="informasjon" rows="5" cols="40" placeholder="Informasjon om ditt kandidatur" readonly>$info</textarea>
    <label for="trukket">Alvslå ditt kandidatur</label>
    <input type="hidden" name="trukket" value="0">
    MKR;
    if ($trukket == "1") { 
        echo "<input type=\"checkbox\" name=\"trukket\" value=\"1\" checked onclick=\"return false;\">";
    } else {
        echo "<input type=\"checkbox\" name=\"trukket\" value=\"1\" onclick=\"return false;\">";
    }
    echo <<<MKR
    </form>
    </section>
    
    <section>
    <h3>Lastopp Bilde</h3>
    <p class="fremheve">Opplasting av bilder er ikke mulig under valgperioden</p>
    <section>
    MKR;
}


$innlogget = $_SESSION['innlogget'];
$bruker = $_SESSION['epost'];
$fulltnavn = $_SESSION['navn'];
$valgperiode = $_SESSION['valgperiode'];

if(!$innlogget) {
    
    header("Location: default.php");
    exit ("Tilgang ikke tillat");
    
}

include 'php/dbconnect.php'; 
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

// $sql = "SELECT * FROM bruker LIMIT 1";
// $d = $mydb->query($sql);
$sql = "SELECT epost, informasjon, bilde, trukket \n"
. "from bruker b INNER JOIN kandidat k \n"
. "on b.epost = k.bruker \n"
. "WHERE epost = :bruker";
$stm = $mydb -> prepare($sql); 
$stm -> bindParam(":bruker", $bruker);
$stm -> execute();
$result = $stm -> fetch(PDO::FETCH_ASSOC);
$info = $result['informasjon'];
$bildeid = $result['bilde'];
$trukket = $result['trukket'];
$stm -> closeCursor();

$title = "Mitt kandidatur";
include 'php/header.php';

echo "<main>";
echo "<h1>$title</h1>";
echo "<section>";
if(!$valgperiode) {
    echo "<h2>Rediger kadidaturinformasjon</h2>";
} else {
    echo "<h2 class = \"fremheve\">Kan ikke rediger kadidaturinformasjon under valgperioden</h2>";
}

if ($bildeid != 0) {
    // echo "Et bilde ligger i db <br/>";
    $hentbilde = "SELECT hvor, tekst, alt FROM bilde WHERE idbilde = ?";
    //   var_dump($hentbilde);
    
    $stm = $mydb -> prepare($hentbilde);
    $stm -> bindParam(1, $bildeid, PDO::PARAM_INT);
    $stm -> execute();
    $bildet = $stm -> fetch(PDO::FETCH_ASSOC);
    // var_dump($bildet);
    $hvor = $bildet['hvor'];
    $alt = $bildet['alt'];
    echo "<img src = \"$hvor\" alt = \"$alt\" height = \"200\" width = \"200\" id = \"profilepic\">";
} else {
    echo "Ingen bilde å vise <a href=\"#lastoppbilde\">Last opp ditt bilde</a>";
}

// if valgperiode forhindre endringer
if(!$valgperiode) {
    redigerbar_forms($fulltnavn, $info, $trukket, $bildeid);
} else {
    lesing_forms($fulltnavn, $info, $trukket);
}

echo "</main>";

include 'php/footer.php';
?>
