<?php
//
//  Module: DB.php - G.J. Watson
//    Desc: Database connectivity
// Version: 1.00
//

final class DB {

    private $database;
    private $username;
    private $password;
    private $hostname;
    private $mysql;

 	function __construct($database, $username, $password, $hostname = 'localhost') {
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->hostname = $hostname;
        $this->mysql = mysqli_connect($hostname, $username, $password, $database);
        if (!$this->mysql) {
            throw new DatabaseException('DB ERROR: ' . mysqli_connect_error());
        }
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

}
?>
