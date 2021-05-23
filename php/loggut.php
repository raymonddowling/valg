<?php 
session_start();

// siden utviklet av Raymond sist endret 11.desember 2020
unset($_SESSION['navn']);
unset($_SESSION['har_stemt']);
$_SESSION['innlogget'] = FALSE;
header("Location: ../default.php");

?>
