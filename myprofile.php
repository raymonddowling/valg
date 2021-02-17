<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Min profile</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/hamburger.js"></script>

    </head>
    <body>

        <header>
            <nav id="menu">
                <a href="default.php"> <img class="dtpics" src="images/election.png" alt="valgurne" height="100" width="130"> </a>
                <button id="hamburgermeny" onclick=toggleMenu()>MENY</button>
                <ul id="menuitems">
                        <li id="home"><a href="index.html">Home</a></li>
                        <li><a href="nominering.html">Nominering</a></li>
                        <li><a href="avstemning.html">Avstemning</a></li>
                        <li><a href="registering.html">Registering</a></li>
                        <li><a href="logginn.html">Logg inn</a></li>
                </ul>
            </nav>
            </header>


<main>
<form action="php/lastopp_bilde.php" method="post" enctype="multipar/form-data">
    <label for="profilbilde">Lastopp et profilbilde</label><br/>
    <input type="file" name="profilbilde" ></input><br/>
    <input type="submit" value="last opp bilde" name="lastopp">
    </form>
</main>

<footer>
	<h3>Kontakt oss</h3>
	<p> Email: r-15@teams.usn.no <span class="copy">&copy; Gruppe R-15 2020</span></p>
</footer>
    </body>
</html>

<?php
session_start();

include 'php/dbconnect.php'; 
$mydb = new mypdo();
$sql = "SELECT * FROM bruker LIMIT 1";
$d = $mydb->query($sql);
?>

<center>
<div class="tablestyle" style="margin-top: 200px;">
<table class="cent">
    <tr>
        <td>ID</td>
        <br>
        <td>Username</td>
        <br>
        <td>Email</td>
        <br>
        <td>Kontaktnummber</td>
   </tr>
</div>
<?php foreach($d as $data)
{
?>

<tr> 
    <td><?php echo $data['fnavn']; ?></td>
    <td><?php echo $data['enavn']; ?></td>
    <td><?php echo $data['epost']; ?></td>
    <td><?php echo $data['passord']; ?></td>
</tr>
<?php
}
?>
</table>
<button class="registerknapp" style="float: left;margin:15px;">Avbryt</button>
<button class="registerknapp" style="float: right;margin:15px;">Ferdig</button>
<button class="registerknapp" style="float: middle;">Bytt passord</button>
<br>
<br>
<br>
<div class="infobox">
<p class="editinfo" contenteditable="true">Rediger informasjon om degselv!</p>
</div>
<!-- 
<br><br><br>
<form action="php/lastopp_bilde.php" method="post" enctype="multipar/form-data">
    <label for="profilbilde">Lastopp et profilbilde</label><br/>
    <input type="file" name="profilbilde" ></input><br/>
    <input type="submit" value="last opp bilde" name="lastopp">
    </form>
 -->

</center>