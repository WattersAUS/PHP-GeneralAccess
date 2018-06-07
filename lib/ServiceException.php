<?php
//
//  Module: ServiceException.php - G.J. Watson
//    Desc: Extend default Exception class to cover our Service (and other general) errors
// Version: 1.01
//

declare(strict_types = 1);

// generic db errors
define("DBCONNECTERROR",         array("message" => "Database connect failed",  "code" => -9990));
define("DBQUERYERROR",           array("message" => "Database query failed",    "code" => -9991));
define("DBINSERTERROR",          array("message" => "Database insert failed",   "code" => -9992));
define("DBUPDATEERROR",          array("message" => "Database update failed",   "code" => -9993));
define("DBGENERALERROR",         array("message" => "Database general failure", "code" => -9999));

// http request / JSON format / token issues
define("REAQMETHODERROR",        array("message" => "Unrecognised HTTP request!",          "code" => -9980));
define("ACCESSTOKENMISSING",     array("message" => "Service was supplied a blank token!", "code" => -9981));
define("INCORRECTTOKENSUPPLIED", array("message" => "Service does not recognise token!",   "code" => -9982));
define("ACCESSDENIED",           array("message" => "Service access has been denied!",     "code" => -9983));
define("TOOMANYREQUESTS",        array("message" => "Token blocked for usage abuse!",      "code" => -9984));
define("TOKENEXPIRED",           array("message" => "Token has expired, request another!", "code" => -9985));

// no idea what went wrong
define("UNKNOWNERROR",           array("message" => "An unknown error has occured!", "code" => -9000));

// lottery service errors
define("ILLEGALDRAWCOUNT",     array("message" => "Draw count out of range!", "code" => -9800));

// quote service errors
define("ILLEGALAUTHORID",      array("message" => "Author ID missing or illegal!", "code" => -9700));
define("ACTIVEAUTHORNOTFOUND", array("message" => "Author not found!",             "code" => -9701));
define("AUTHORNOQUOTES",       array("message" => "Author has no quotes!",         "code" => -9702));

class ServiceException extends Exception {

    // message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    // custom JSON fragment containing message
    public function jsonString() {
        $outputArray["code"]    = $this->code;
        $outputArray["message"] = $this->message;
        return json_encode($outputArray, JSON_NUMERIC_CHECK);
    }
}
?>
