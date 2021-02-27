<?php
session_start();
$innlogget = $_SESSION['innlogget'];
$bruker = $_SESSION['epost'];

include 'php/dbconnect.php'; 
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

// $sql = "SELECT * FROM bruker LIMIT 1";
// $d = $mydb->query($sql);
$sql = "SELECT epost, enavn, fnavn, informasjon, bilde, trukket \n"
. "from bruker b INNER JOIN kandidat k \n"
. "on b.epost = k.bruker \n"
. "WHERE epost = :bruker";
$stm = $mydb -> prepare($sql);
$stm -> bindParam(":bruker", $bruker);
$stm -> execute();
$result = $stm -> fetch(PDO::FETCH_NUM);

$title = "Mitt kandidatur";
include 'php/header.php';
echo <<<MKR
<main>
<form action="php/lastopp_bilde.php" method="post" enctype="multipart/form-data">
    <label for="profilbilde">Lastopp et profilbilde</label><br/>
    <input type="file" name="profilbilde" ></input><br/>
    <input type="submit" value="last opp bilde" name="lastopp">
    </form>
</main>
MKR;



var_dump($result);


include 'php/footer.php';
?>

<center>
<div class="tablestyle" style="margin-top: 200px;">
<table class="cent">
    <tr>
        <td>ID</td>
        <br>
        <td>Username</td>
        <br>
        <td>Email</td>
        <br>
        <td>Kontaktnummber</td>
   </tr>
</div>
<?php foreach($d as $data)
{
?>

<tr> 
    <td><?php echo $data['fnavn']; ?></td>
    <td><?php echo $data['enavn']; ?></td>
    <td><?php echo $data['epost']; ?></td>
    <td><?php echo $data['passord']; ?></td>
</tr>
<?php
}
?>
</table>
<button class="registerknapp" style="float: left;margin:15px;">Avbryt</button>
<button class="registerknapp" style="float: right;margin:15px;">Ferdig</button>
<button class="registerknapp" style="float: middle;">Bytt passord</button>
<br>
<br>
<br>
<div class="infobox">
<p class="editinfo" contenteditable="true">Rediger informasjon om degselv!</p>
</div>
<!-- 
<br><br><br>
<form action="php/lastopp_bilde.php" method="post" enctype="multipar/form-data">
    <label for="profilbilde">Lastopp et profilbilde</label><br/>
    <input type="file" name="profilbilde" ></input><br/>
    <input type="submit" value="last opp bilde" name="lastopp">
    </form>
 -->

</center>