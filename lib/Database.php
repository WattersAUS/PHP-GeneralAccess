<?php
//
//  Module: Database.php - G.J. Watson
//    Desc: Database connectivity
// Version: 1.00
//

require_once("ServiceException.php");

final class Database {

    private $database;
    private $username;
    private $password;
    private $hostname;
    public  $mysqli;

 	function __construct($database, $username, $password, $hostname = 'localhost') {
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->hostname = $hostname;
    }

    function getDatabase() {
    	return $this->database;
    }

    function getUser() {
    	return $this->username;
    }

    function getHostname() {
    	return $this->hostname;
    }

    function getConnection() {
    	return $this->mysql;
    }

    function connect() {
        try {
            mysqli_report(MYSQLI_REPORT_STRICT);
            $this->mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        } catch (mysqli_sql_exception $e) {
            throw new ServiceException(DBCONNECTERROR["message"], DBCONNECTERROR["code"]);
        }
    }

    function select($sql) {
        $result = $this->mysqli->query($sql);
        if (!$result) {
            throw new ServiceException(DBQUERYERROR["message"], DBQUERYERROR["code"]);
        }
        return $result;
    }

    function insert($sql) {
        $result = $this->mysqli->query($sql);
        if (!$result) {
            throw new ServiceException(DBINSERTERROR["message"], DBINSERTERROR["code"]);
        }
        return $this->mysqli->insert_id;
    }

    function update($sql) {
        $result = $this->mysqli->query($sql);
        if (!$result) {
            throw new ServiceException(DBUPDATEERROR["message"], DBUPDATEERROR["code"]);
        }
        return $this->mysqli->insert_id;
    }

    function close() {
        $this->mysqli->close();
    }
}
?>
