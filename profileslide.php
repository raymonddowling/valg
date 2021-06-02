<!-- Denne siden er utviklet av Sahatsawat Wongsurin. Sist endret 11.04.2021 -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Min profile</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />


    </head>
    <body>

        <header>
            <nav id="menu">
                <a href="default.php"> <img class="dtpics" src="images/election.png" alt="valgurne" height="100" width="130"> </a>
                <button id="hamburgermeny" onclick=toggleMenu()>MENY</button>
                <ul id="menuitems">
                        <li id="home"><a href="index.html">Home</a></li>
                        <li><a href="../Gamle_filer/nominering.html">Nominering</a></li>
                        <li><a href="../Gamle_filer/avstemning.html">Avstemning</a></li>
                        <li><a href="registering.html">Registering</a></li>
                        <li><a href="logginn.html">Logg inn</a></li>
                </ul>
            </nav>
            </header>

			

<!-- container for å swipe frem og tilbake -->


<center>
    <div class="slider">
    
      <a href="#slide-1">1</a>
      <a href="#slide-2">2</a>
      <a href="#slide-3">3</a>
      <a href="#slide-4">4</a>
    
      <div class="slides">
        <div id="slide-1">
                <img src="getImage.php?id=1"/>
				<div class="info">
					<h2>Kristina Schaer</h2>
					<table>
<tr>
<th>informasjon</th>
</tr>
<?php

include 'php/dbconnect.php'; 
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}
// $sql = "SELECT * FROM bruker LIMIT 1";
// $d = $mydb->query($sql);
$sql = "SELECT epost, fnavn, enavn, mann FROM bruker WHERE brukertype = 1";
$result = $mydb->query($sql);

if ($result->num_rows > 0) {

    foreach($mydb -> query($sql) as $row) {

      echo '<label style="left;"><li><input type="checkbox" name="tabell" value='.$row["epost"].'</label></li>';

    }
}

?>
</table>
				</div>
        </div>
        <div id="slide-2">
			<img src="getImage.php?id=2"/>
			<div class="info">
				<h2>Snorre Dias</h2>
				<p>Heisann! Jeg heter Snorre Dias og er kandidat for denne nomineringen!</p>
			</div>
        </div>
        <div id="slide-3">
			<img src="getImage.php?id=3"/>
			<div class="info">
				<h2>Kevin Øksnavad</h2>
				<p>Heisann! Jeg heter Kevin Øksnavad og er kandidat for denne nomineringen!</p>
			</div>
        </div>
        <div id="slide-4">
			<img src="getImage.php?id=4"/>
			<div class="info">
				<h2>Ingrid Helle</h2>
				<p>Heisann! Jeg heter Ingrid Helle og er kandidat for denne nomineringen!</p>
			</div>
        </div>
      </div>
    </div>
    </center>



<footer>
	<h3>Kontakt oss</h3>
	<p> Email: r-15@teams.usn.no <span class="copy">&copy; Gruppe R-15 2020</span></p>
</footer>


    </body>
</html>