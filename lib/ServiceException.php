<?php
//
//  Module: ServiceException.php - G.J. Watson
//    Desc: Extend default Exception class to cover our Service (and other general) errors
// Version: 1.03
//

declare(strict_types = 1);

// generic db errors
define("DBCONNECTERROR",         array("message" => "Database connect failed",  "code" => -9990));
define("DBQUERYERROR",           array("message" => "Database query failed",    "code" => -9991));
define("DBINSERTERROR",          array("message" => "Database insert failed",   "code" => -9992));
define("DBUPDATEERROR",          array("message" => "Database update failed",   "code" => -9993));
define("DBGENERALERROR",         array("message" => "Database general failure", "code" => -9999));

// http request issues
define("HTTPMETHODERROR",        array("message" => "Unrecognised HTTP request!",         "code" => -9980));
define("HTTPSUPPORTERROR",       array("message" => "Unsupported HTTP request!",          "code" => -9981));
define("HTTPROUTINGERROR",       array("message" => "Unsupported routing request made!",  "code" => -9982));

// JSON format / token issues
define("ACCESSTOKENMISSING",     array("message" => "Service was supplied a blank token!", "code" => -9970));
define("INCORRECTTOKENSUPPLIED", array("message" => "Service does not recognise token!",   "code" => -9971));
define("ACCESSDENIED",           array("message" => "Service access has been denied!",     "code" => -9972));
define("TOOMANYREQUESTS",        array("message" => "Token blocked for usage abuse!",      "code" => -9973));
define("TOKENEXPIRED",           array("message" => "Token has expired, request another!", "code" => -9974));

// no idea what went wrong
define("UNKNOWNERROR",           array("message" => "An unknown error has occured!", "code" => -9000));

// lottery service errors
define("ILLEGALDRAWCOUNT",     array("message" => "Draw count out of range!", "code" => -9800));

// quote service errors
define("ILLEGALAUTHORID",      array("message" => "Author ID missing or illegal!", "code" => -9700));
define("ACTIVEAUTHORNOTFOUND", array("message" => "Author not found!",             "code" => -9701));
define("AUTHORNOQUOTES",       array("message" => "Author has no quotes!",         "code" => -9702));

class ServiceException extends Exception {

    private $htmlResponseCode;
    private $htmlResponseMsg;

    // message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
        switch ($code) {
            case -9700:
                $this->htmlResponseCode = 400;
                $this->htmlResponseMsg  = "Bad Request";
                break;
            case -9970:
            case -9971:
                $this->htmlResponseCode = 401;
                $this->htmlResponseMsg  = "Unauthorized";
                break;
            case -9972:
            case -9974:
                $this->htmlResponseCode = 403;
                $this->htmlResponseMsg  = "Forbidden";
                break;
            case -9701:
            case -9702:
            case -9800:
                $this->htmlResponseCode = 406;
                $this->htmlResponseMsg  = "Not Acceptable";
                break;
            case -9973:
                $this->htmlResponseCode = 429;
                $this->htmlResponseMsg  = "Too Many Requests";
                break;
            case -9980:
            case -9981:
            case -9982:
                $this->htmlResponseCode = 501;
                $this->htmlResponseMsg  = "Not Implemented";
                break;
            case -9000:
            case -9990:
            case -9991:
            case -9992:
            case -9993:
            case -9999:
            default:
                $this->htmlResponseCode = 500;
                $this->htmlResponseMsg  = "Internal Server Error";
        }
    }

    public function getHTMLResponseCode() {
        return $this->htmlResponseCode;
    }

    public function getHTMLResponseMsg() {
        return $this->htmlResponseMsg;
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
