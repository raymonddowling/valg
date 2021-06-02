<?php
session_start();

/* #################################################################

        siden utviklet av Raymond Dowling sist endret 2.juni 2021 

    ################################################################   */


include 'php/dbconnect.php';
$mydb = new mypdo();
if (!$mydb) {
    exit("Feil med forbindelse");
}

$innlogget = $_SESSION['innlogget'];
$title = "Informasjon om kandidat";

if(!$innlogget || !isset($_GET['kinfo'])) {
    header('default.php');
    exit("Ikke tillat");
}

$valgt_kandidat = $_GET['kinfo'];

$sql = "SELECT hvor, alt, CONCAT(fnavn, \" \", enavn) as navn, epost, informasjon, COUNT(enavn) AS tot FROM kandidat\n"
    . "INNER JOIN bruker ON kandidat.bruker = bruker.epost\n"
    . "INNER JOIN bilde ON kandidat.bilde = bilde.idbilde\n"
    . "WHERE trukket = 0 AND epost = :vk\n"
    . "ORDER BY enavn";

$stm = $mydb -> prepare($sql);
$stm -> bindParam(":vk", $valgt_kandidat);
$stm -> execute();
$res = $stm -> fetch(PDO::FETCH_NUM);

if($res[5] != "1") {
    exit("Feil med informasjonen");
}

$hvor = $res[0];
$alt = $res[1];
$navn = $res[2];
$ep = $res[3];
$info = $res[4];

include 'php/header.php';

echo <<<MKR
<main>
<section id="kandidatene">
<h1>$title</h1>
<section id="kandidat_head">
    <h2>$navn</h2>
    <h3>$ep</h3>
</section>
<section id="kandidat_pic">
    <img src=$hvor alt=$alt height="200" width="200" id="profilepic">
</section>
<article id="kandidat_info">
    <p>$info</p>
</article>
<a href="avstemning.php">Tilbake til avstemning</a>
</section>
</main>

MKR;

include 'php/footer.php';

?>

    
    
    
    
    
    
    
    
    
    
    
    
    
    