<?php
session_start();

// siden utviklet av Raymond Dowling sist endret 20.january 2021
$innlogget = $_SESSION['innlogget'];
$nommineringsperiode = $_SESSION['nomineringsperiode'];

if (!$innlogget || !$nommineringsperiode) {  // redirect to defalut if accessed via adressbar illeagly
    echo "kom direkte";
    // sleep(3);
    header("location: default.php");
    // header("refresh 3; url=default.php");
    exit ("siden er ikke tilgjenlig nå");
}

include 'php/dbconnect.php'; //php/dbconnect.php  & dbconnect_local.php
// include 'php/dbconnect_Local.php'; //php/dbconnect.php  & dbconnect_local.php
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}
?>
<!DOCTYPE html>
<!-- Denne siden er utviklet av Serhat Bawer Guzel sist endret 16.oktober 2020-->

<html lang="no">l

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

<label>Velg Personene du vil nominere: </label>
<select class="groupnr" name="groupnr" required autofocus>
    <?php
        // echo "<p>e-post til brukeren: $name</p>";
        $sql = "SELECT epost, CONCAT(enavn, \" \" , fnavn) AS fultnavn FROM bruker ORDER BY enavn";
        // $sql2 = "SELECT * FROM bruker LIMIT 2";
        $stm = $mydb -> prepare($sql);
        $res = $stm -> execute();
        var_dump($res);
        while($row =  $stm -> fetch(PDO::FETCH_ASSOC)) {
            // echo "<p>Text</p>";
            // var_dump($row);
            $lineje = "<option value = " . $row['epost'].">" . $row['fultnavn']."</option>"; // #### BRUK STRING VAR ####
            //    $lineje = ("<h1>" . $row['fultnavn'] ."</h1>");
            echo $lineje;
        }
        // echo <<EOT
        ?>
</select>
<label for="kandidat_info">Oppgir informasjon om kadidatet (valgfritt)</label>
<textarea id="kandidat_info" name="kandidat_info" placeholder="Hvorfor nominier du denne person?" rows="5" cols="40"></textarea>
<button type="submit" name="nominated" class="registerknapp">Nominer</button>
        
</form>

<?php
    if (isset($_COOKIE['nominated'])) {
        echo "<p id='nominasjon'> " . $_COOKIE['nominated'] . "</p>" ;
        header("refresh: 4");
// print_r($_COOKIE);>
    }
    ?>

</main>

<footer> <!-- onload=formtest()> -->
<h3>Kontakt oss</h3>
<p> Email: r-15@teams.usn.no <span class="copy">&copy; Gruppe R-15 2020</span></p>
</footer>
</body>
</html>


