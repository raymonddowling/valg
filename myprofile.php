<?php
session_start();

// siden utvilklet av Raymond Dowling sist endret 4.mars 2021

$innlogget = $_SESSION['innlogget'];
$bruker = $_SESSION['epost'];
$fulltnavn = $_SESSION['navn'];

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
echo "<h2>Rediger kadidaturinformasjon</h2>";

if ($bildeid != 0) {
    echo "Et bilde ligger i db <br/>";
    $hentbilde = "SELECT hvor, tekst, alt FROM bilde WHERE idbilde = ?";
    //   var_dump($hentbilde);
    
    $stm = $mydb -> prepare($hentbilde);
    $stm -> bindParam(1, $bildeid, PDO::PARAM_INT);
    $stm -> execute();
    $bildet = $stm -> fetch(PDO::FETCH_ASSOC);
    var_dump($bildet);
    $hvor = $bildet['hvor'];
    echo "<img src = \"$hvor\">";
} else {
    echo "Ingen bilde å vise <a href=\"#lastoppbilde\">Last opp ditt bilde</a>";
}

echo <<<MKR
<form name="editprofile" action="php/profil_action.php" method="post">
    <label for="navn">Navn</label>
    <input type="text" name="navn" value="{$fulltnavn}" readonly>
    <label for="informasjon">Rediger din informasjon</label>
    <textarea name="informasjon" rows="5" cols="40" placeholder="Informasjon om ditt kandidatur">$info</textarea>
    <label for="trukket">Alvslå ditt kandidatur</label>
    <input type="hidden" name="trukket" value="0">
MKR;
    If ($trukket == "1") { 
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
    <input type="submit" value="last opp bilde" name="lastopp">
</form>
<section>
</main>
MKR;

// var_dump($result);

include 'php/footer.php';
?>

<center>
<div class="tablestyle" style="margin-top: 200px;">
<table class="cent">
    <tr>
        <td>ID</td>
        <br>
        <td>Username</td>
        <br>
        <td>Email</td>
        <br>
        <td>Kontaktnummber</td>
   </tr>
</div>
<?php foreach($d as $data)
{
?>

<tr> 
    <td><?php echo $data['fnavn']; ?></td>
    <td><?php echo $data['enavn']; ?></td>
    <td><?php echo $data['epost']; ?></td>
    <td><?php echo $data['passord']; ?></td>
</tr>
<?php
}
?>
</table>
<button class="registerknapp" style="float: left;margin:15px;">Avbryt</button>
<button class="registerknapp" style="float: right;margin:15px;">Ferdig</button>
<button class="registerknapp" style="float: middle;">Bytt passord</button>
<br>
<br>
<br>
<div class="infobox">
<p class="editinfo" contenteditable="true">Rediger informasjon om degselv!</p>
</div>
<!-- 
<br><br><br>
<form action="php/lastopp_bilde.php" method="post" enctype="multipar/form-data">
    <label for="profilbilde">Lastopp et profilbilde</label><br/>
    <input type="file" name="profilbilde" ></input><br/>
    <input type="submit" value="last opp bilde" name="lastopp">
    </form>
 -->

</center>