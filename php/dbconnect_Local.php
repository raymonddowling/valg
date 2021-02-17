<?php

class mypdo extends PDO {
    public function __construct() {
        $drv = 'mysql';
        $host = "localhost"; 
        $dbname = "valg";
        $usr = "root";
        $pwrd = "";
        $dsn = $drv.':host='.$host.';dbname='.$dbname;
        
        parent::__construct($dsn, $usr, $pwrd);
    }
}
?>