<?php
//
//  Module: Validate.php - G.J. Watson
//    Desc: Contains validation modules to use through out scripts
// Version: 1.06
//

require_once("ServiceException.php");

final class Validate {

    function __construct() {
    }

    function checkVariableExistsInArray($key, $array) {
        if (empty($key) || empty($array)) {
            return FALSE;
        }
        if (! array_key_exists($key, $array)) {
            return FALSE;
        }
        if (empty($array[$key])) {
            return FALSE;
        }
        return TRUE;
    }

    function isValidNumeric($number) {
        return is_numeric($number);
    }

    function isValidDateTime($dateTime) {
        $frmt ="Y-m-d H:i:s";
        $dt = DateTime::createFromFormat($frmt, $dateTime);
        return $dt && $dt->format($frmt) == $dateTime;
    }

    function isValidIpAddress($ipAddress) {
        return filter_var($ipAddress, FILTER_VALIDATE_IP) == $ipAddress;
    }

    function isValidGUID($guid) {
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $guid) !== 1) {
            return FALSE;
        }
        return TRUE;
    }
}
?>
