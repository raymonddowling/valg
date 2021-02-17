<?php
session_start();

// $navn = $_SESSION['navn'];
//  unset($_SESSION['nominated']);

include 'dbconnect_Local.php';
// include 'dbconnect.php';

$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbinedelse");
}

if(isset ($_POST['nominated'])) {
    
    $nominerte =  $_POST['groupnr'];
    $info = $_POST['kandidat_info'];
    
    $sql = "SELECT bruker, informasjon FROM kandidat WHERE bruker = :valgt";
    $stm = $mydb -> prepare($sql);
    $stm -> bindParam(":valgt", $nominerte);
    $stm -> execute();
    $result = $stm -> fetch(PDO::FETCH_ASSOC);
    // echo "Select Row Count  = " . $stm -> rowCount() ."<br>";
    
    // referanse-integriget i databasen skal sørge for at rowCount = enten 1 eller 0
    if($stm -> rowCount() == 1) { // allrede nominert
        echo "nominert -- legg til info <br>";
        if($result['informasjon'] != null) {
            $update = "UPDATE kandidat SET informasjon = CONCAT(informasjon, '\n', :info) ";
            $update .="WHERE bruker = :valgt";
        } else {
            $update = "UPDATE kandidat SET informasjon = :info ";
            $update .="WHERE bruker = :valgt";
        }
        $ps = $mydb -> prepare($update);
        $ps -> bindParam(":valgt", $nominerte);
        $ps -> bindParam(":info", $info);
        $ps -> execute();

        /* echo $update."<br>";
        echo "Update Row Count  = " . $ps -> rowCount();
        echo '<scrpt type="text/javascript">alert(Vellykket);</script>';
         */

        // $_SESSION['nominated'] = "Vellykket nominasjon";

        setcookie('nominated', "nominasjonen er registreret", time()+3, '/' );

        echo "<br> nominated cookie =  "; // . $_COOKIE['nominated'];
        print_r($_COOKIE);

        header("location: ../nominering.php" . SID); //?$reg=true");
        
    } else { // ikke nominert
        $insert = "INSERT INTO kandidat (bruker, informasjon) VALUES (:valgt, :info)";
        $ps = $mydb -> prepare($insert);
        $ps -> bindParam(":valgt", $nominerte);
        $ps -> bindParam(":info", $info);
        $ps -> execute();
        echo $insert."<br>";
        echo "insert Row Count  = " . $ps -> rowCount();
        
        setcookie('nominated', "nominasjonen er registreret", time()+10, '/' );
        header("location: ../nominering.php" . SID); //?$reg=true");

        
        echo '<scrpt>alert(Mislykket);</script>';
        
    }
}

?>
