<?php
//
//  Module: ServiceErrors.php - G.J. Watson
//    Desc: Simple Generic Message Error Handler
// Version: 1.00
//

declare(strict_types = 1);

// generic errors
const DATABASEERROR          = -9999;
const REAQMETHODERROR        = -9998;
const ACCESSTOKENMISSING     = -9997;
const INCORRECTTOKENSUPPLIED = -9996;
const ACCESSDENIED           = -9995;
const TOOMANYREQUESTS        = -9994;
const TOKENEXPIRED           = -9993;
const UNKNOWNERROR           = -9000;

// service call errors
const ILLEGALDRAWCOUNT       = -9800;
const ILLEGALAUTHORID        = -9700;

// not found id errors
const ACTIVEAUTHORNOTFOUND   = -9600;

// all ok
const OK                     = 0000

final class ServiceError {

    public $error;
    public $message;

    function __construct(int $error) {
        $this->error = $error;
        $this->message = setErrorMessage($this->error);
    }

    function setErrorMessage(int $error) {
        $this->error = $error;
        $this->message = "An unknown error has occured!";
        switch ($this->error) {
            case DATABASEERROR:
                $this->message = "A Database error has occured!";
                break;
            case REAQMETHODERROR:
                $this->message = "The service does not recognise this HTTP request!";
                break;
            case ACCESSTOKENMISSING:
                $this->message = "The supplied token to the service is blank!";
                break;
            case INCORRECTTOKENSUPPLIED:
                $this->message = "The service does not recognise this token as a valid user!";
                break;
            case ACCESSDENIED:
                $this->message = "Access to this service has been denied!";
                break;
            case TOOMANYREQUESTS:
                $this->message = "This token has been blocked for making excessive requests! Access is suspended until requests have fallen within the agreed usage plan!";
                break;
            case TOKENEXPIRED:
                $this->message = "The supplied token has expired, please request another one!";
                break;
            case ILLEGALDRAWCOUNT:
                $this->message = "Draw count must be between 1 and 1000!";
                break;
            case ILLEGALAUTHORID:
                $this->message = "Author ID must be supplied and a numeric!";
                break;
            case ACTIVEAUTHORNOTFOUND:
                $this->message = "Author ID either does not exist, or has no active quotes!";
                break;
            default:
                $this->message = "There has been an unknown error in the service!";
                break;
        }
    }

    function getError(): int {
        return $this->error;
    }

    function getErrorMessage(): string {
        return "ERROR (".$this->error."): ".$this->message;
    }

    function getErrorJSONString(): string {
        $outputArray["msg"]        = $this->getErrorMessage();
        $outputArray["status"]     = $this->getError();
        return json_encode($outputArray, JSON_NUMERIC_CHECK);
    }
}
?>
