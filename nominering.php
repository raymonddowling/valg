<?php
session_start();

// <!-- HTML-siden er utviklet av Serhat Bawer Guzel sist endret 16.oktober 2020-->
// siden utviklet av Raymond Dowling sist endret 31.mai 2021

$innlogget = $_SESSION['innlogget'];
$nommineringsperiode = $_SESSION['nomineringsperiode'];
$title = "Nominering";

if (!$innlogget || !$nommineringsperiode) {  // redirect to defalut if accessed via adressbar illeagly
    header("location: default.php");
    exit ("siden er ikke tilgjenlig nå");
}

include 'php/dbconnect.php'; 
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

include 'php/header.php';

echo <<<MKR
<main>
<h1>$title</h1>

<form name="nominering" action="php/legg_till_kandidat.php" method="post">

    <label>Velg Personen du vil nominere: </label>
    <select name="personer" required autofocus>
MKR;
    $sql = "SELECT epost, CONCAT(enavn, \" \" , fnavn) AS fultnavn, trukket
     FROM bruker LEFT OUTER JOIN kandidat
     ON kandidat.bruker = bruker.epost
     WHERE bruker.brukertype = 1
     ORDER BY enavn";
    $stm = $mydb -> prepare($sql);
    $res = $stm -> execute();
    var_dump($res);
    while($row =  $stm -> fetch(PDO::FETCH_ASSOC)) {
        if($row['trukket'] == '1') {
            $lineje = "<option disabled=\"true\" value = " . $row['epost'] .">" . $row['fultnavn']."*</option>"; // #### BRUK STRING VAR ####
        } else {
            $lineje = "<option value = " . $row['epost'] .">" . $row['fultnavn']."</option>"; // #### BRUK STRING VAR ####
        }
        echo $lineje;
    }
echo <<<MKR
    </select>
    <p>Personer med * akseptere ikke nominasjoner</p>
    <label for="kandidat_info">Oppgir informasjon om kadidatet (valgfritt)</label>
    <textarea id="kandidat_info" name="kandidat_info" placeholder="Hvorfor nominier du denne person?" rows="5" cols="20"></textarea>
    <button type="submit" name="nominated" class="registerknapp">Nominer</button>
</form>
MKR;
    
if (isset($_COOKIE['nominated'])) {
    $msg = $_COOKIE['nominated'];
    // echo "<p id='nominasjon'> $msg </p>" ;
    // header("refresh: 5");
    echo "<script>alert(\"$msg\");</script>";
}
    
echo "</main>\n";
    
include 'php/footer.php';

?>


