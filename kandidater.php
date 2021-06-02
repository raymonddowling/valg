<?php
session_start();

// siden utviklet av Raymond Dowling sist endtret 1.juni 2021;

include 'php/dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit ("Feil med forbindesle");
}

$innlogget = $_SESSION['innlogget'];
$title = "Kandidater";

include 'php/header.php';
echo "<main>\n <h1>$title</h1>\n <section id=\"kandidatene\">";
echo <<<MKR
<section id="kandidat_head"></section>
    <section id="kandidat_pic"></section>
    <article id="kandidat_info"></article>
MKR;
?>

<script>let personer = [];
function visKandidat(index) {
    const kh = document.getElementById("kandidat_head");
    const kp = document.getElementById("kandidat_pic");
    const ki = document.getElementById("kandidat_info");

    kh.innerHTML = "kandidat head"; // personer[index].navn;
    kp.innerHTML = personer[index].hvor;
    ki.innerHTML = personer[index].informasjon;
}

<?php

$sql = "SELECT hvor, alt, CONCAT(fnavn, \" \", enavn) as navn, epost, informasjon, bilde FROM kandidat\n"
    . "INNER JOIN bruker ON kandidat.bruker = bruker.epost\n"
    . "INNER JOIN bilde ON kandidat.bilde = bilde.idbilde\n"
    . "WHERE trukket = 0\n"
    . "ORDER BY enavn";

$stm = $mydb -> prepare($sql);
$stm -> execute();

while($row = $stm -> fetch(PDO::FETCH_ASSOC)) {
    $hvor = $row['hvor'];
    $alt = $row['alt'];
    $navn = $row['navn'];
    $ep = $row['epost'];
    $info = $row['informasjon'];

    $line = "let elm = new Kandidat(\"$hvor\", \"$alt\", \"$navn\", \"$ep\", \"$info\");";
    echo($line);
    echo "personer.push(elm);";
}
?>
visKandidat(0);

    // echo "<script>addKandidater(\"$hvor\", \"$alt\", \"$navn\", \"$ep\", \"$info\");
    </script>;
    
<?php
/* echo <<<MKR
    
    <section id="kandidat_head"></section>
    <section id="kandidat_pic"></section>
    <article id="kandidat_info"></article>
</section>
</main>
MKR; */

include 'php/footer.php';

?>