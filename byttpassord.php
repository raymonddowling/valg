<?php
session_start();

/* ## Siden utviklet av Raymond Dowling sist endret 30.mai 2021 ###
  ### Bekfret gamle passord for å så bytte #######
  */
include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
  exit("Feil med forbindelse");
}

$title = "Bytt Passord";
$innlogget = $_SESSION['innlogget'];

include 'php/header.php';

echo <<<MKR
<main>
  <form action="php/oppdater_password.php" method="post">
    <label for="oldpassword">Bekfret nåværende passord</label>
    <input type="password" name="oldpassword" id="oldpassword" placeholder="Nåværende passord...">
    <button type="submit" class="registerknapp" name="bekreft_pord">Bekreft</button>
  </form>
</main>
MKR;

if(isset($_COOKIE['gamle_passord'])) {
  $msg = $_COOKIE['gamle_passord'];
  // echo "<script>alert(\"$msg\")<script>";
  echo "<p class=\"fremheve\">{$msg}</p>";
}
include 'php/footer.php';

?>