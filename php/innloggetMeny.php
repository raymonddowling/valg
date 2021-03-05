<?php
//session_start(); filen brukt bare i include
// Siden utviklet av Raymond Dowling sist endret 10.desember 2020
// Siden utviklet av Raymond Dowling sist endret 05.februar 2021

// $navn = "Logget inn som " . $_SESSION['navn'];
$name = $_SESSION['navn'];
$kandidat = $_SESSION['kandidat'];
$brukertype = $_SESSION['brukertype'];
$nomineringsperiode = $_SESSION['nomineringsperiode'];
$valgperiode = $_SESSION['valgperiode'];

function brukerMeny() {
	// meny for innlogget vanligbruker og ekstra hvis brukeren er kandidat
	/* $url = $_SERVER['REQUEST_URI'];
	$siden = parse_url($url, PHP_URL_PATH);
	echo "siden = " . $siden;
	var_dump($siden);
 	if (str_contains($siden, 'default.php')) { ########### ERROR UNDEFINED FUNCTION ####################
		$kobling = "#";		######### forsøk på å hindre Page-Refresh på default.php siden
	} else {
		$kobling = "default.php";
	}
  */
	echo <<<MKR
	<a href="default.php""> <img class="dtpics" src="images/election.png" alt="valgurne" height="100" width="130"> </a>
	<button id="hamburgermeny" onclick=toggleMenu()>MENY</button>
	<ul id="menuitems">
	<li id="home"><a href="default.php">Home</a></li>
	<li><a href="byttpassord.php">Bytt passord</a></li>
	MKR;
	// echo "<li>Kandiat is " . $GLOBALS['kandidat']. $GLOBALS['brukertype'] ."</li>";
	if($GLOBALS['nomineringsperiode']) { echo "<li><a href=\"nominering.php\">Nominering</a></li>";	}
	if($GLOBALS['valgperiode']) { echo "<li><a href=\"avstemning.php\">Avstemning</a></li>";}
	if($GLOBALS['kandidat']) { echo "<li><a href=\"myprofile.php\">Kandidatur</a></li>";	}
}

function adminMeny() {
	echo '<li><a href="valgadmin.php">Administere Valget</a></li>';
	echo '<li><a href="valgadmin.php">Administere Valget SOPA</a></li>';
}

brukerMeny();
if ($brukertype == 2) {
	adminMeny();
}

// echo "Active page is " . $_SERVER['REQUEST_URI'];

echo "</ul> \n
	<a href=\"php/loggut.php\" class=\"logginnBtn\">Logg ut  " .$GLOBALS['name']."</a>";

/* 
<!-- kode mellom nav taggene -->
<a href="default.php"> <img class="dtpics" src="images/election.png" alt="valgurne" height="100" width="130"> </a>
<button id="hamburgermeny" onclick=toggleMenu()>MENY</button>
<ul id="menuitems">
	<li id="home"><a href="default.php">Home</a></li>
	<li><a href="nominering.php">Nominering</a></li>
	<li><a href="avstemning.php">Avstemning</a></li>
	<li><a href="byttpassord.php">Bytt passord</a></li>
	<?php
	if ($kandidate){ echo '<li><a href="myprofile.php">Kandidatur</a></li>'; }
	if ($brukertype == 2) {
		echo '<li><a href="valgadmin.php">Administere Valget</a></li>';
		echo '<li><a href="valgadmin.php">Administere Valget SOPA</a></li>';
	}
	?>
	<!-- <li><?php echo $byttpassord ?>Bytt Passord</a></li>  ?? ungår bytting mellome html og php modus??? -->
	<!--<li><?php echo $navn ?></li>-->
	
</ul>
<a href="php/loggut.php" class="logginnBtn">Logg ut <?php echo " ".$name?></a>
 */

?>