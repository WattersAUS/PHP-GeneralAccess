<?php
//
//  Module: Common.php - G.J. Watson
//    Desc: Contains modules to use through out scripts
// Version: 2.01
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

    private function logDateTime() {
        return "[ ".$this->getGeneratedDateTime()." ] ";
    }

    private function logMessage($type, $message) {
        return $this->logDateTime().$type.": ".$message."\n";
    }

    function logINFOMessage($message) {
        return $this->logMessage(" INFO", $message);
    }

    function logDEBUGMessage($message) {
        return $this->logMessage("DEBUG", $message);
    }

    function logERRORMessage($message) {
        return $this->logMessage("ERROR", $message);
    }
}
?>
