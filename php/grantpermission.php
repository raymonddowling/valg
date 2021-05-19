<?php
session_start();

include 'dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

if(isset($_POST['endrerollen'])) {

    $epost = $_POST["bruker"];
    $role = $_POST["role"];
    $sql = "UPDATE bruker SET brukertype = :bt WHERE epost = :ep";
    $stm = $mydb -> prepare($sql);
    $stm -> bindParam (":bt",$role);
    $stm -> bindParam (":ep",$epost);
    $stm -> execute();
    setcookie("endretrollen", "Rollen Endret", time()+3, "/");
    header ("Location: ../adminpermission.php" .SID);
    
} else {
    header ("Location: ../default.php");
}

?>





















