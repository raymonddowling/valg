<?php
session_start();
// Siden utviklet av Arientim Sopa 20.Mai.2021
// Siden utviklet av Raymond Dowling sist endret 2.juni 2021

$innlogget = $_SESSION['innlogget'];
$brukertype = $_SESSION['brukertype'];
$title = "Endre brukers rolle";

if($brukertype !=2) {
    header("Location: default.php");
    exit("Ikke tillat");
}

include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}
include 'php/header.php';

if(isset($_COOKIE['endretrollen'])) {
    $msg = $_COOKIE['endretrollen'];
    echo "<script>alert(\"$msg\");</script>";
    echo "<p>Changed Roles</p>";
}

//Velg enn vanlig bruker som ikke er kandidat
$sql = "SELECT epost, CONCAT(enavn, \" \" , fnavn) AS fultnavn FROM bruker
         WHERE brukertype = 1 AND epost NOT IN (SELECT bruker FROM kandidat WHERE trukket = 0) ORDER BY enavn";
$stm = $mydb -> prepare($sql);
$stm -> execute();

echo <<<MKR
<main>
<h1>$title</h1>
<form name = "permission" action = "php/grantpermission.php" method = "post">
<label for="bruker"> Velg bruker </label> 
<select name="bruker">
MKR;
while($row =  $stm -> fetch(PDO::FETCH_ASSOC)) {
    $lineje = "<option value = " . $row['epost'].">" . $row['fultnavn']."</option>"; // #### BRUK STRING VAR ####
    echo $lineje;
}
//Velger å endre til admin eller kontrollør
echo <<<MKR
</select>
<label for="rolle"> Velg rolle </label>
<select name = "rolle">
    <option value = "2"> Admin </option>
    <option value = "3"> Kontrollør </option>
</select>
 
<button type="submit" class="registerknapp" name="endrerollen"> Endre Rollen </button>
</form>
</main>
MKR;

include 'php/footer.php';

?>