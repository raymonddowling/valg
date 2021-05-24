<?php
session_start();

/* 
######## siden utviklet av Raymond Dowling ##########
######## sist endtret 23.mai 2021 ####################

 */

include 'dbconnect.php';

$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbinedelse");
}

if(isset ($_POST['nominated'])) {
    
    $nominerte =  $_POST['groupnr'];
    $info = $_POST['kandidat_info'];
    $forstegang = FALSE; // nominerte for første gang

    $count = "SELECT COUNT(bruker) FROM kandidat WHERE bruker = :valgt";
    $sth = $mydb -> prepare($count);
    $sth -> bindParam(":valgt", $nominerte);
    $sth -> execute();
    $res = $sth -> fetch(PDO::FETCH_NUM);
    if($res[0] == "0") $forstegang = TRUE;
    
    $sql = "SELECT bruker, informasjon FROM kandidat WHERE bruker = :valgt";
    $stm = $mydb -> prepare($sql);
    $stm -> bindParam(":valgt", $nominerte);
    $stm -> execute();
    $result = $stm -> fetch(PDO::FETCH_ASSOC);
    
    if(!$forstegang) { // allrede nominert
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

        setcookie('nominated', "nominasjonen er registreret", time()+3, '/' );

    } else { // ikke nominert
        $ingen = 0;
        $insert = "INSERT INTO kandidat (bruker, informasjon, stemmer) VALUES (:valgt, :info, :stemmer)";
        $ps = $mydb -> prepare($insert);
        $ps -> bindParam(":valgt", $nominerte);
        $ps -> bindParam(":info", $info);
        $ps -> bindParam(":stemmer", $ingen, PDO::PARAM_INT);
        $ps -> execute();
        
        setcookie('nominated', "nominasjonen er registreret", time()+3, '/' );
        
    }
}

?>
