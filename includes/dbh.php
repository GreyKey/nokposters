<?php
//Quick config path creation
if(strpos(getcwd(), 'login') !== false) {
    require_once('../config.php');
}
else {
    require_once('config.php');
}

class Dbh {

    //Database Connection Properties
    protected $servername = DB_HOST;
    protected $username = DB_USER;
    protected $password = DB_PASS;
    protected $dbname = DB_NAME;

    // connection property
    public $conn = null;

    // call constructor
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error){
            echo "Fail " . $this->conn->connect_error;
        }
    }

    
}
?>