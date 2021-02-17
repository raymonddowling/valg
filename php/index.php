<?php
@session_start(['cookie_lifetime' => 86400,
'read_and_close'  => true,]);
$innlogget = $_SESSION['innlogget']; //$_SESSION['innlogget'] = TRUE;
?>
<!DOCTYPE html>
<!-- siden utvikelt av Raymond Dowling sist endret 08.november 2020 -->

<html lang="no">

<head>
<meta charset ="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Valgsystem</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/hamburger.js"></script>
</head>

<body>
<header>
<nav id="menu">
    <?php
   // $innlogget = TRUE;
        if($innlogget) {
            include 'innloggetMeny.php';
        } else {
            include 'utloggetMeny.php';
        }
    ?>
</nav>
</header>

<main>
<?php echo 'Today is '.date('l H:i').'<br/>'; ?>
<?php
     include 'dbconnect.php';
    $mydb = new mypdo();
    //$dbh = new PDO('mysql:host=127.0.0.1;dbname=valg', 'root', '');

    if(!$mydb) {
        echo 'somthing went wrong';
    } else {
        echo 'everything is ok';
    }
?>


<h2>Hvorfor skolevalg?</h2><button>Test button</button>
<p>Her kan du <a href="logginn.html">logg inn</a> Hvis du ikke har en bruker kan du <a href="registering.html">registrere deg</a>
	<img class="dtpics" id="choicepick" src="images/choiceindex.jpg" alt="ubesluttsom mann" height="400" width="400"> </p>

<h2>Hvorfor burde du stemme?</h2>
<p>Skolevalgene gir gode perspektiv på hva unge mener er viktig og hva som er det rette parti for dem.
Resultatene blir offentliggjort noen dager før Stortings- eller lokalvalget, og resultatet herfra kan ha påvirkning på både partiene og velgerne.
Er du ikke gammel nok til å stemme i det vanlige valget, er dette derfor den beste måten å si hva du mener på.</p>




<h2>Hvem skal du stemme på?</h2>
<p>Kunnskap er et viktig grunnlag for å ta en avgjørelse. Og jo mer du vet om samfunnet rundt deg.
Derfor er informasjon viktig. Mediene har en rett og en plikt til å gi deg viktig informasjon, og med kunnskap fra skolen får du grunnlag for å forstå informasjonen du får.
Bruk også nettet aktivt, les brosjyrer og løpesedler du får fra partiene, og spør dem som står på stand om det du lurer på.</p>

<h2>Hvordan stemmer du?</h2>
<p>For å stemme registrer du deg på nettsiden <a href="registering.html"> registrer</a> så går du på <a href="avstemning.html"> avstemming</a> og der kan man stemme på hvilke som helst kanditater som man vil stemme på.
Eventuelt så kan du nominere nye deltakere som ikke står på lista, <a href="nominering.html"> nominer</a> her.</p>

<h2>Hvorfor har vi laget denne nettsiden?</h2>
<p>Vi har laget denne nettsiden fordi vi har ett gruppe prosjekt der vi skal lage en nettside som er mobilfirst
der vi kan registrere bruker, nominere canditater, ha avstemmninger på canditater og logge seg inn.
Nettsiden skal også være mulig å bruke på datamaskin men skal fokuseres på mobil.</p>

</main>








<footer>
	<h3>Kontakt oss</h3>
	<p> Email: r-15@teams.usn.no <span class="copy">&copy; Gruppe R-15 2020</span></p>
</footer>

</body>
</html>
