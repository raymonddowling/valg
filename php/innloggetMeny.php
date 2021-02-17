<?php
//session_start(); filen brukt bare i include
// Siden utviklet av Raymond Dowling sist endret 10.desember 2020
// Siden utviklet av Raymond Dowling sist endret 05.februar 2021

// $navn = "Logget inn som " . $_SESSION['navn'];
$name = $_SESSION['navn'];
$kandidate = $_SESSION['kandidat'];


?> 

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
	?>
	<!-- <li><?php echo $byttpassord ?>Bytt Passord</a></li>  ?? ungår bytting mellome html og php modus??? -->
	<!--<li><?php echo $navn ?></li>-->
	
</ul>
<a href="php/loggut.php" class="logginnBtn">Logg ut <?php echo " ".$name?></a>
