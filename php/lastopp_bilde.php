<?php
session_start();

// siden utviklet av Raymond Dowling sist endret 27.februar 2021

$innlogget = $_SESSION['innlogget'];
$epost = $_SESSION['epost'];

include 'dbconnect.php'; 

$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

echo "Post " . var_dump($_POST) . "<br>";
echo "<br><br>";
echo "Files " . var_dump($_FILES) . "<br>";

if ($_FILES['profilbilde']['error'] == 0) {
    echo "no error";
    move_uploaded_file($_FILES['profilbilde']['tmp_name'], "../profilbilder/$epost");
}

?>