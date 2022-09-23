<?php
//
//  Module: GetAuthorisationToken.php - G.J. Watson
//    Desc: Extract the auth token from HTML headers
// Version: 1.00
//

require_once("Validate.php");
require_once("ServiceException.php");

function getAuthorisationTokenFromHeaders($check) {
    $authArray = getallheaders();
    if (! $check->checkVariableExistsInArray("Authorization", $authArray)) {
        throw new ServiceException(ACCESSTOKENMISSING["message"], ACCESSTOKENMISSING["code"]);
    }
    if (strlen($authArray["Authorization"]) <> 43) {
        throw new ServiceException(INCORRECTTOKENSUPPLIED["message"], INCORRECTTOKENSUPPLIED["code"]);
    }
    list($authType, $token) = explode(" ", $authArray["Authorization"], 2);
    if (strcasecmp($authType, "Bearer") <> 0) {
        throw new ServiceException(AUTHORISATIONFAILURE["message"], AUTHORISATIONFAILURE["code"]);
    }
    if (! $check->isValidGUID($token)) {
        throw new ServiceException(INCORRECTTOKENSUPPLIED["message"], INCORRECTTOKENSUPPLIED["code"]);
    }
    return $token;
}
?>