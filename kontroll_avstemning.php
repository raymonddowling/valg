<?php
session_start();

/* Siden uvtivilet av Raymond Dowling sist endret 26.mai 2021 */

$innlogget = $_SESSION['innlogget'];
$brukertype = $_SESSION['brukertype'];
$title = "Kontrollere avstemning";

if($brukertype != 3) { //kun kontrollør har tilgang
    header("Location: default.php");
    exit("Ikke tillat");
}

include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("Feil med forbindelse");
}

include 'php/header.php';
echo "<main>\n";
echo "<h1>$title</h1>\n";
$sql = "SELECT CONCAT(enavn, \" \", fnavn) as fultnavn, stemmer, epost FROM kandidat INNER JOIN bruker ON bruker.epost = kandidat.bruker";
$stm = $mydb -> prepare($sql);
$ok =$stm -> execute();

while($row = $stm -> fetch(PDO::FETCH_ASSOC)) {
    $linje = "<details>\n
            <summary> {$row['fultnavn']} <em>Antall Stememr:</em> <strong>{$row['stemmer']}</strong> </summary>\n <ol>\n";
    
        $sql1 = "SELECT epost, CONCAT(enavn, \" \", fnavn) AS fultnavn FROM bruker WHERE stemme = :epost";
        $stm1 = $mydb -> prepare($sql1);
        $stm1 -> bindParam(":epost", $row['epost']);
        $stm1 -> execute();

        while($rad = $stm1 -> fetch(PDO::FETCH_ASSOC)) {
            $linje .= "<li>{$rad['fultnavn']} - {$rad['epost']} </li>\n";
        }
        $stm1 -> closeCursor();

    $linje .= "</ol>\n</details>\n";
    echo $linje;
}
$stm -> closeCursor();

echo "</section> \n </main>\n";

include 'php/footer.php';

?>