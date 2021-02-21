<?php
session_start();

$innlogget = $_SESSION['innlogget'];

// include 'php/dbconnect_Local.php'; // ############ LOCAL TEST #########################3
include 'php/dbconnect.php'; // ############ FELLES DB #########################3

$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

?>

<!DOCTYPE html>
<html lang="no">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nominering</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<script src="js/hamburger.js"></script>
</head>
<body>

<header>
	<nav id="menu">
    <?php
        if($innlogget) {
            include 'php/innloggetMeny.php';
        } else {
            include 'php/utloggetMeny.php';
        }
    ?>
	</nav>
</header>

<main>
    <!-- if not kadidatet then redirect to nominiering -->

    <form action="php/lastopp_bilde.php" method="post" enctype="multipar/form-data">
    <label for="profilbilde">Lastopp et profilbilde</label><br/>
    <input type="file" name="profilbilde" ></input><br/>
    <input type="submit" value="last opp bilde" name="lastopp">
    </form>
    
</main>

</body>
</html>


<!-- <?php /*
include 'php/dbconnect.php'; 
$mydb = new mypdo();
$sql = "SELECT * FROM bruker";
$d = $mydb->query($sql);
?> 
<center>
<div class="box">
<table border="2" cellpadding ="5" cellspacing="5" align="center">
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
    <td><?php echo $data['brukertyoe']; ?></td>
</tr>
<?php
}
*/?>
</table>
</center> -->