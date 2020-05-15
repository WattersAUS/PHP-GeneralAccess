<?php
//
//  Module: Common.php - G.J. Watson
//    Desc: Contains modules to use through out scripts
// Version: 2.04
//

final class Common {

    function __construct() {
    }

    static function getGeneratedDate() {
        return date("Y-m-d");
    }

    static function getGeneratedDateTime() {
        return date("Y-m-d H:i:s");
    }

    private function logMessage($type, $message) {
        return $this->getGeneratedDateTime()." [ ".$type." ] ".$message."\n";
    }

    function logINFOMessage($message) {
        return $this->logMessage("INFO", $message);
    }

    function logDEBUGMessage($message) {
        return $this->logMessage("DEBUG", $message);
    }

    function logERRORMessage($message) {
        return $this->logMessage("ERROR", $message);
    }

    function printINFOMessage($message) {
        print($this->logINFOMessage($message));
    }

    function printDEBUGMessage($message) {
        print($this->logDEBUGMessage($message));
    }

    function printERRORMessage($message) {
        print($this->logERRORMessage($message));
    }
}
?>