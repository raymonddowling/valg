<?php
session_start();
// siden utivklet av Raymond Dowling sist endret 08.januar 2021
// @session_start(['cookie_lifetime' => 86400,
// 'read_and_close'  => true,]);
$innlogget = $_SESSION['innlogget']; //$_SESSION['innlogget'] = TRUE;

?>

<!DOCTYPE html>
<!-- siden utviklet av Arientim Sopa sist endret 16.oktober 2020-->

<html lang="no">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Avstemning</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<script src="js/hamburger.js"></script>
</head>

<body>
	<header>
		<nav id="menu">
        <?php
         // $innlogget = TRUE;
        if($innlogget) {
            include 'php/innloggetMeny.php';
        } else {
            include 'php/utloggetMeny.php';
        }
    	?>
        </nav>
	</header>

<main>
<h2>Avstemning</h2>


<h3>Kandidater</h3>

<legend>Hvem har du lust å stemme på i år?</legend>
<form action="actionform.php" id="form1" name="form1" method="POST">
	<label>
		<input type="radio" name="Avstemning" value="Kristina Schaer" id="Avstemning_0" />
		Kristina Schaer
	 </label>
   <br/>
	<label>
		<input type="radio" name="Avstemning" value="Snorre Dias" id="Avstemning_1" />
		Snorre Dias
	</label>
  <br/>
	<label>
		<input type="radio" name="Avstemning" value="Kevin Øksnavad" id="Avstemning_2" />
		Kevin Øksnavad
	</label>
  <br/>
	<label>
		<input type="radio" name="Avstemning" value="Ingrid Helle" id="Avstemning_3" />
		Ingrid Helle
	</label>
  <br/>
	<button type="submit" class="registerknapp">Stem</button>
</form>
</main>

<footer>
<h3>Kontakt oss</h3>
<p> Email: r-15@teams.usn.no <span class="copy">&copy; Gruppe R-15 2020</span></p>
</footer>

</body>
</html>
