<?php

class mypdo extends PDO {
    public function __construct() {
        $drv = 'mysql';
        $host = "localhost";
        // $host = "S381.usn.no"; //** ping gir 32.134 "128.39.19.159"; **
        $dbname = "valg2021";
        $usr = "usr_valg";
        $pwrd = "pw_valg2021";
        $dsn = $drv.':host='.$host.';dbname='.$dbname;
        
        parent::__construct($dsn, $usr, $pwrd);
    }
}
?>