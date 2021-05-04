<?php
/* 
Siden utviklet av Raymond Dowling sist endret 18.feburar 2021
HTML code som er på starten av hver side fra HTML til MAIN
sides title må settes i $title var på siden denne filen er inkludert i 
$innlogget må settes til $_SESSION[innlogget]
 */

echo <<<MKR
<!DOCTYPE html>
<html lang="no">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$title</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<script src="js/hamburger.js"></script>
<script src="js/forms.js"></script>
</head>
<body>

<header>
	<nav id="menu">
MKR;
        if($innlogget) {
            include 'php/innloggetMeny.php';
        } else {
            include 'php/utloggetMeny.php';
        }

echo <<<MKR
	</nav>
</header>
MKR;
?>

