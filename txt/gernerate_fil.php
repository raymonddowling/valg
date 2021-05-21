<?php
// Siden utviklet av Raymond Dowling sist endret 11.mai 2021

// hent standard top og bunn deler til en side
$header = file_get_contents ("header.txt");
$footer = file_get_contents ("footer.txt");

$main = "<main>
    <p>a paragraph</p>
</main>";

$fil = fopen("taimot.html", "w");
fwrite($fil, $header."\n");
fwrite($fil, $main."\n");
fwrite($fil, $footer);
fclose($fil);

?>