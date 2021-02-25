<?php 
session_start();
//Siden utviklet av Raymond Dowling sist endret 17.feburar 2021
// sjekk om logginn er admin
//on valginfo
include 'dbconnect_Local.php'; // ############ LOCAL TEST ####################################
// include 'dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}

function isKandidat() {
    echo "Call isKandidat";
    // ###### sjekk om bruker er kandidat ############
    $sql1 = "SELECT bruker FROM kandidat WHERE bruker = :bruker"; //AND avslått FALSE
    $stm1 = $GLOBALS['mydb'] -> prepare($sql1);
    $stm1 -> bindParam(":bruker", $bruker);
    $stm1 -> execute();
    $res = $stm1 -> fetch(PDO::FETCH_ASSOC);
    if($stm1 -> rowCount() == 1) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function isNominering() {
    $sql = "SELECT startforslag, sluttforslag FROM valg";
    return isGyldigPeriode($sql);
}

function isValg() {
    $sql = "SELECT startvalg, sluttvalg FROM valg";
    return isGyldigPeriode($sql);
}

function isGyldigPeriode($sql) {
    echo "\nIsGyldigPeriode\n";
    var_dump($sql);
    $stm = $GLOBALS['mydb'] -> prepare($sql);
    $stm -> execute();
    $res = $stm -> fetch(PDO::FETCH_ASSOC);
    print_r($res);
    //Sjekk mot perioden mot dagens dato
    /* if (date('Y-m-d') >= $res[0] && date('Y-m-d') <= $res[1]) {
        return TRUE;
    } else {
        return FALSE;
    } */

}

if(isset($_POST["logginn"])) { // knapp trykket fra logginn siden
    // echo "logginn knappen trykket ";
    $salt = "IT2_2021";
    $passord = $_POST["password"];
    $bruker = $_POST["username"];
    $ps = sha1($salt.$passord);
    $sql = "SELECT * FROM bruker WHERE epost = :bruker AND passord = :ps";
    $trygg ="SELECT COUNT(*) FROM bruker WHERE epost = :bruker AND passord = :ps";
    $stm = $mydb->prepare($sql);
    $stm -> bindParam(":bruker", $bruker);
    $stm -> bindParam(":ps", $ps);
    $stm->execute();
    
    $result = $stm -> fetch(PDO::FETCH_ASSOC);
    // echo "dump result count " . $stm -> rowCount();    var_dump($result); // ######## 23/1/21 får forventet reslutatet for riktig og galt passord
    
    
    if($stm -> rowCount() == 1) { //skjekk innloggingsinformasjon mot databasen
        
        
        $fulltnavn = $result['fnavn']." ".$result['enavn'];
        $brukertype = $result['brukertype']; // #### 17.feb sprint 4 tar være på bruketype og justere innloggetMeny.php
        $_SESSION['navn'] = $fulltnavn;
        $_SESSION['innlogget'] = TRUE;
        $_SESSION['epost'] = $bruker;
        $_SESSION['brukertype'] = $brukertype; // #### Set i cookie
        $_SESSION['kandidat'] = isKandidat();
        $_SESSION['nomineringsperiode'] = isNominering();
        $_SESSION['valgperiode'] = isValg();
        // echo '<script>alert("Logginn vellykket");</script>';
        // echo '<script>window.location.assign("../avsteming.php"</script>';
        // var_dump($kandidat);
        // echo "<br> res" . var_dump($res);
        // echo "brukertype:  $brukertype";
        //header("Location: ../avstemning.php");
        
    } else {
        // echo '<script>alert("Logginn mislykkes");</script>';
        header("Location: ../logginn.html"); //mislykket logginn
        // echo "logginn mislykkes";
    }
    
} else {
    // echo '<script>alert("Logginn mislykkes");</script>';
    header("Location: ../logginn.html"); //skrevet siden i url
}


?>
