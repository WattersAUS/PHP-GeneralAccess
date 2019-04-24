<?php
//
//  Module: Validate.php - G.J. Watson
//    Desc: Contains validation modules to use through out scripts
// Version: 1.05
//

require_once("ServiceException.php");

final class Validate {

    function __construct() {
    }

    function variableExists($key, $message, $code, $array) {
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

    function numericVariable($key, $message, $code, $array) {
        $this->variableExists($key, $message, $code, $array);
        if (!is_numeric($array[$key])) {
            throw new ServiceException($message, $code);
        }
        return;
    }

    function variableCheck($key, $message, $code, $len, $array) {
        $this->variableExists($key, $message, $code, $array);
        if (strlen($array[$key]) < 1 || strlen($array[$key]) > $len) {
            throw new ServiceException($message, $code);
        }
        return;
    }

    function datetimeCheck($datetimestr) {
        $frmt ="Y-m-d H:i:s";
        $dt = DateTime::createFromFormat($frmt, $datetimestr);
        return $dt && $dt->format($frmt) == $datetimestr;
    }

    function datetimeVariable($key, $message, $code, $array) {
        $this->variableExists($key, $message, $code, $array);
        if ($this->datetimeCheck($array[$key]) == FALSE) {
            throw new ServiceException($message, $code);
        }
        return;
    }

    function ipAddressVariable($key, $message, $code, $array) {
        $this->variableExists($key, $message, $code, $array);
        if (filter_var($array[$key], FILTER_VALIDATE_IP) == FALSE) {
            throw new ServiceException($message, $code);
        }
        return;
    }

    function GUIDCheck($guid, $message, $code) {
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $guid) !== 1) {
            throw new ServiceException($message, $code);
        }
        return;
    }
}
?>
