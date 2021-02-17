<?php
session_start();

// siden utviklet av Raymon Dowling sist endret 05.februar 2021

$innlogget = $_SESSION['innlogget'];

// include 'dbconnect_Local.php'; // ############ LOCAL TEST #########################3
include 'dbconnect.php'; // ############ FELLES DB #########################3

$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

echo "Post " . var_dump($_POST) . "<br>";
echo "<br><br>";
echo "Files " . var_dump($_FILES) . "<br>";

?>