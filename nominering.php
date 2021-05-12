<?php
session_start();

// siden utviklet av Raymond Dowling sist endret 20.january 2021
// siden utviklet av Raymond Dowling sist endret 12.mai 2021

$innlogget = $_SESSION['innlogget'];
$nommineringsperiode = $_SESSION['nomineringsperiode'];

if (!$innlogget || !$nommineringsperiode) {  // redirect to defalut if accessed via adressbar illeagly
    header("location: default.php");
    exit ("siden er ikke tilgjenlig nå");
}

include 'php/dbconnect.php'; 
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}
?>
<!DOCTYPE html>
<!-- Denne siden er utviklet av Serhat Bawer Guzel sist endret 16.oktober 2020-->

<html lang="no">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nominering</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<script src="js/hamburger.js"></script>
<script src="js/forms.js"></script>
</head>
<body>

<header>
	<nav id="menu">
    <?php
        if($innlogget) {
            include 'php/innloggetMeny.php';
        } else {
            include 'php/utloggetMeny.php';
        }
    ?>
	</nav>
</header>

<main>
<h1>Nominering</h1>

<form name="nominering" action="php/legg_till_kandidat.php" method="post">

<label>Velg Personen du vil nominere: </label>
<select class="groupnr" name="groupnr" required autofocus>
    <?php
        $sql = "SELECT epost, CONCAT(enavn, \" \" , fnavn) AS fultnavn FROM bruker ORDER BY enavn";
        $stm = $mydb -> prepare($sql);
        $res = $stm -> execute();
        var_dump($res);
        while($row =  $stm -> fetch(PDO::FETCH_ASSOC)) {
            $lineje = "<option value = " . $row['epost'].">" . $row['fultnavn']."</option>"; // #### BRUK STRING VAR ####
            echo $lineje;
        }
        ?>
</select>
<label for="kandidat_info">Oppgir informasjon om kadidatet (valgfritt)</label>
<textarea id="kandidat_info" name="kandidat_info" placeholder="Hvorfor nominier du denne person?" rows="5" cols="20"></textarea>
<button type="submit" name="nominated" class="registerknapp">Nominer</button>
        
</form>

<?php
    if (isset($_COOKIE['nominated'])) {
        $msg = $_COOKIE['nominated'];
        // echo "<p id='nominasjon'> $msg </p>" ;
        // header("refresh: 5");
        echo "<script>alert(\"$msg\");</script>";
    }
    ?>

</main>

<footer>
<h3>Kontakt oss</h3>
<p> Email: r-15@teams.usn.no <span class="copy">&copy; Gruppe R-15 2020</span></p>
</footer>
</body>
</html>


