<?php
/* 
########## siden utviklet av Raymond Dowling #####################
########## sist endret 6.mai 2021 ################################
 */

$title = "Logg inn";
$innlogget = FALSE;

include "php/header.php";

echo <<<MKR
<main>
<h1>$title</h1>
<form action="php/innlogging_sjekk.php" method="post" onsubmit="passordskjekk">
    <label for="username">Brukernavn</label> <br/>
    <input type="email" name="username" id="username" placeholder="Skriv epost today" required autofocus> <br/>
    <label for="password">Passord</label> <br/>
    <input type="password" name="password" id="password" placeholder="Skriv passord" required> <br/>
    <button type="submit" name="logginn" class="registerknapp">Logg inn</button>
</form>
<a href="glemtpassord.html" id="glemtpord">Glemt passord?</a>

MKR;
if(isset($_COOKIE['logginnFeil'])) {
    $msg = $_COOKIE['logginnFeil'];
    echo "<script>alert(\"$msg\");</script>";
    
}
echo "
</main>";

include "php/footer.php";
