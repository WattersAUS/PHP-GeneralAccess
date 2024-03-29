<?php
//
//  Module: ServiceException.php - G.J. Watson
//    Desc: Extend default Exception class to cover our Service (and other general) errors
// Version: 1.14
//

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
define("MALFORMEDREQUEST",       array("message" => "Request format is not recognised!",  "code" => -9983));

// JSON format / token issues
define("ACCESSTOKENMISSING",     array("message" => "Service was supplied a blank token!", "code" => -9970));
define("INCORRECTTOKENSUPPLIED", array("message" => "Service does not recognise token!",   "code" => -9971));
define("ACCESSDENIED",           array("message" => "Service access has been denied!",     "code" => -9972));
define("TOOMANYREQUESTS",        array("message" => "Token blocked for usage abuse!",      "code" => -9973));
define("TOKENEXPIRED",           array("message" => "Token has expired, request another!", "code" => -9974));
define("TOKENALLOCFAILURE",      array("message" => "Failed to allocate a new token!",     "code" => -9975));
define("AUTHORISATIONFAILURE",   array("message" => "Authorisation failure!",              "code" => -9976));

// no idea what went wrong
define("UNKNOWNERROR",           array("message" => "An unknown error has occured!", "code" => -9000));

// lottery service errors
define("ILLEGALLOTTERYID",       array("message" => "Lottery ID missing or illegal!",          "code" => -9800));
define("ILLEGALDRAWCOUNT",       array("message" => "Draw count out of range or not numeric!", "code" => -9801));

// quote service errors
define("UNKNOWNAUTHOR",          array("message" => "Unknown Author requested!",               "code" => -9700));
define("ACTIVEAUTHORNOTFOUND",   array("message" => "Author not found!",                       "code" => -9701));
define("AUTHORNOQUOTES",         array("message" => "Author has no quotes!",                   "code" => -9702));
define("ILLEGALDATE",            array("message" => "Start date supplied missing or illegal!", "code" => -9703));
define("NONEWQUOTESFOUND",       array("message" => "No new quotes found from supplied date!", "code" => -9704));
define("NOMATCHINGQUOTESFOUND",  array("message" => "No matching quotes found!",               "code" => -9705));
define("SEARCHNOTINLIMITS",      array("message" => "Search vars not in limits (1..32)!",      "code" => -9706));
define("SEARCHVARNOTFOUND",      array("message" => "Search variable not found!",              "code" => -9707));

// filesystem error
define("FILENOTFOUND",           array("message" => "Cannot find the input file!", "code" => -9600));

class ServiceException extends Exception {
    private $htmlResponseCode;
    private $htmlResponseMsg;
    // message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        switch ($code) {
            case -9600:
            case -9700:
            case -9706:
            case -9707:
            case -9800:
                $this->htmlResponseCode = 400;
                $this->htmlResponseMsg  = "Bad Request";
                break;
            case -9970:
            case -9971:
            case -9976:
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
            case -9704:
            case -9705:
                $this->htmlResponseCode = 404;
                $this->htmlResponseMsg  = "Not Found";
                break;
            case -9703:
            case -9801:
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
            case -9975:
            case -9983:
            case -9990:
            case -9991:
            case -9992:
            case -9993:
            case -9999:
            default:
                $this->htmlResponseCode = 500;
                $this->htmlResponseMsg  = "Internal Server Error";
        }
        $this->htmlResponseMsg = sprintf("%d %s", $this->htmlResponseCode, $this->htmlResponseMsg);
        parent::__construct($message, $code, $previous);
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