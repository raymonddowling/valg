<?php
// Siden utviklet av Raymond Dowling sist endret 30.april 2020
// Bare 'Home' 'Registering' og 'Logg inn'

echo <<<MKR
<a href="default.php"> <img class="dtpics" src="images/election.png" alt="valgurne" height="100" width="130"> </a>
<a href="logginn.php" class="logginnBtn">Logg inn</a>
<button id="hamburgermeny" onclick=toggleMenu()>MENY</button>
    <ul id="menuitems">
		<li id="home"><a href="default.php">Home</a></li>
		<li><a href="txt/valg_opplysning.html">Valg Opplysning</a></li>
		<li><a href="registering.html">Registering</a></li>
	</ul>
MKR;	
?>