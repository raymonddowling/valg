<?php
session_start();

  $conn_db = mysql_connect("localhost","root","") or die();
  $sel_db = mysql_select_db("updatepassword",$conn_db) or die();
  if(isset($_POST['re_password']))
  {
  $old_pass=$_POST['old_pass'];
  $new_pass=$_POST['new_pass'];
  $re_pass=$_POST['re_pass'];
  $bruker = $_SESSION['bruker'];
  $chg_pwd=mysql_query("select * from bruker where id='1'");
  $chg_pwd1=mysql_fetch_array($chg_pwd);
  $data_pwd=$chg_pwd1['password'];
  if($data_pwd==$old_pass){
  if($new_pass==$re_pass){
    $update_pwd=mysql_query("update bruker set password='$new_pass' where id='1'");
    echo "<script>alert('Ditt passord har nå blitt endret!'); window.location='byttpassord.php'</script>";
  }
  else{
    echo "<script>alert('Ditt nye passord og gjentatte passord er ikke likt!'); window.location='byttpassord.php'</script>";
  }

  }
  else
  {
  echo "<script>alert('Ditt gamle passord er feil!'); window.location='byttpassord.php'</script>";
  }}
?>
