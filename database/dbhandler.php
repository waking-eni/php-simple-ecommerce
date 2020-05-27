<?php

/*
Database handler
*/

define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('database', 'ecommerce-simple');
define('port', '3308');

class Database {
    private $con = null;
    static $inst = null;

    public function __construct() {
        try {
            $this->con = new mysqli(host, user, pass, database, port);
        } catch (Exception $e) {
            die ('Unable to connect to the database.');
        }
    }

    public function __destruct() {
        if($this->con) {
            $this->con->close();
        }
    }

    static function getInstance() {
        if(self::$inst == null) {
            self::$inst = new Database();
        }
        return self::$inst;
    }

    //check if the table exists
    public function tableExists($tableName) {
        $check = $this->con->query("SELECT 1 FROM $tableName");
        if($check !== false && $check->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //count number of rows found matching a spesific query
    public function numRows($sql) {
        $numRows = $this->con->query($sql);
        return $numRows->num_rows;
    }

    //select from database without binding parameters
    public function getWithoutParameters($sql) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    //select from database with a binding parameter
    public function getWithParameter($sql, $param) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("s", $param);
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    //insert data into the database
    public function insertData($sql, $param1, $param2, $param3) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("sss", $param1, $param2, $param3);
            $stmt->execute();
        }
    }

    //delete data from the database
    public function deleteData($sql, $param) {
        $stmt = $this->con->stmt_init();
        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("s", $param);
            $stmt->execute();
        }
    }

    public function checkLogIn($sql, $param1, $param2) {
        $stmt = $this->con->stmt_init();

        if(!$stmt->prepare($sql)) {
            throw new \Exception( 'Prepare failed' );
        } else {
            $stmt->bind_param("ss", $param1, $param2);
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    public function runQuery($sql) {
    	$this->con->query($sql);
    	echo mysqli_error($this->con);
    }

}
