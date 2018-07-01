<?php
//
//  Module: Common.php - G.J. Watson
//    Desc: Contains modules to use through out scripts
// Version: 2.00
//

require_once("ServiceException.php");

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

    function validateURLVariableExists($key, $message, $code, $array) {
        if (empty($key) || empty($array)) {
            throw new ServiceException($message, $code);
        }
        if (! array_key_exists($key, $array)) {
            throw new ServiceException($message, $code);
        }
        if (empty($array[$key])) {
            throw new ServiceException($message, $code);
        }
        return;
    }

    function validateNumericURLVariable($key, $message, $code, $array) {
        $this->validateURLVariableExists($key, $message, $code, $array);
        if (!is_numeric($array[$key])) {
            throw new ServiceException($message, $code);
        }
        return;
    }
}
?>
