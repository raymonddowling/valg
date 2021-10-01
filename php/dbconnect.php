<?php

class mypdo extends PDO {
    public function __construct() {
        $drv = 'mysql';
        $host = "localhost";
        $dbname = "valg2021";
        $usr = "usr_valg";
        $pwrd = "pw_valg2021";
        $dsn = $drv.':host='.$host.';dbname='.$dbname;
        
        parent::__construct($dsn, $usr, $pwrd);
    }
}
?>
