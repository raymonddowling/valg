<?php
session_start();

/* ## Siden utviklet av Raymond Dowling sist endret 30.mai 2021 ####
  ### Etter at gamle passordet er bekreftet kan man velge et nytt ##
  */
$innlogget = $_SESSION['innlogget'];
$title = "Velg nytt passord";
$epost = $_SESSION['epost'];

include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
  exit("Feil med forbindelse");
}

if(isset($_GET['op'])) { //gamle passord bekreftet
    
  include 'php/header.php';
    
  echo <<<MKR
  <main>
  <h1>$title</h1>
  <h2>Velg nytt passord for $epost</h2>
  <form action="php/nyttpassord.php" method="POST">
      <label for="password">Velg passord</label>
      <br/>
      <input type="password" placeholder="Skriv passord" name="password" id="password" required>
      <br/>
      <label for="passord2">Gjenta passordet</label>
      <br/>
      <input type="password" placeholder="Gjenta passordet" name="passord2" id="passord2" onblur="passordsjekk()" required>
      <input type="hidden" name="epost" value="{$epost}"/>
      <button type="submit" class="registerknapp" name="bekreft">Bekreft</button>
  </form>
  </main>
  MKR;
  include 'php/footer.php';

} else {
  header("Location: default.php");
  exit("Ikkt tillat");
}


?>