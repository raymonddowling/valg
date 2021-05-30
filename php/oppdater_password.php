<?php
session_start();

/* ### Siden utviklet av Raymond Dowling sist endret 30.mai 2021 ####
  ### bekreft at gamle passord ####
  ###################################################### */

include 'dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
  exit("Feil med forbindelse");
}

$bruker = $_SESSION['epost'];

if(isset($_POST['bekreft_pord'])) {
  $gamle = $_POST['oldpassword'];
  $salt = "IT2_2021";
  $gamle_passord = sha1($salt.$gamle);

  $sql = "SELECT COUNT(*) FROM bruker WHERE epost = :mail AND passord = :gamle";
  $stm = $mydb -> prepare($sql);
  $stm -> bindParam(":mail", $bruker);
  $stm -> bindParam(":gamle", $gamle_passord);
  $stm -> execute();
  $res = $stm -> fetch(PDO::FETCH_NUM);

  if($res[0] == '1') {
    header("Location: ../velgpassord.php?op=1" . SID);
  } else {
    setcookie("gamle_passord", "Feil Passord", time()+3, "/");
    header("Location: ../byttpassord.php" . SID);
  }
} else {
  header("Location: ../default.php");
  exit("Ikke tillat");
}
?>
