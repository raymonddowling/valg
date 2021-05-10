<?php
session_start();

include 'dbconnect.php';
$mydb = new mypdo();
if(!$mydb) {
    exit("feil med forbindelse");
}
echo <<<MKR
        //Liste av brukere i databasen
        //Velger enn vanlig bruker å endrer til bruker 2
        -->
        MKR;
        $sql = "SELECT epost, CONCAT(enavn, \" \" , fnavn) AS fultnavn FROM bruker ORDER BY enavn WHERE brukertype == 1";
        // $sql = "SELECT * FROM bruker";
        $stm = $mydb -> prepare($sql);
        $stm -> execute();
        $result = $stm -> fetchAll();

        echo <<<MKR
         < form name = "permission" action = "php/Grantpermission.php" method = "post" >
         <label> velg bruker </label> 
         <select name = "bruker">
         MKR;
        while($row =  $stm -> fetch(PDO::FETCH_ASSOC)) {
            // echo "<p>Text</p>";
            // var_dump($row);
            $lineje = "<option value = " . $row['epost'].">" . $row['fultnavn']."</option>"; // #### BRUK STRING VAR ####
            //    $lineje = ("<h1>" . $row['fultnavn'] ."</h1>");
            echo $lineje;
        }
        echo <<<MKR
        </select>
        <label> velg role </label>
        <select name = "role">
        <option value = "2"> admin </option>
        <option value = "3"> kontrollør </option>
        </select>
 
    <button type="submit" name="Endre role" class = "registrerknapp">
    </form>
    MKR;
?>