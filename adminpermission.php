<?php
session_start();

$innlogget = $_SESSION['innlogget'];
$title = "Endre brukers rolle";

include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}
include 'php/header.php';

//Liste av brukere i databasen
//Velger enn vanlig bruker å endrer til bruker 2
$sql = "SELECT epost, CONCAT(enavn, \" \" , fnavn) AS fultnavn FROM bruker WHERE brukertype = 1 ORDER BY enavn";
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
echo <<<MKR
</select>
<label for="rolle"> Velg rolle </label>
<select name = "rolle">
    <option value = "2"> Admin </option>
    <option value = "3"> Kontrollør </option>
</select>
 
<button type="submit" class="registerknapp"> Endre Rollen </button>
</form>
</main>
MKR;

include 'php/footer.php';

?>