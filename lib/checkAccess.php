<?php
//
//  Module: CheckAccess.php - G.J. Watson
//    Desc: Class to check the user accessing the service is allowed too
// Version: 1.00
//

require_once("ServiceError.php");

final class CheckAccess {

    private $token;
    private $status;
    private $requests;
    private $period;

    function __construct($db, $token) {
        $this->token    = $token;
        $this->status   = OK;
        $this->requests = 0;
        $this->period   = 0;

        if (empty($token)) {
            $this->status = ACCESSTOKENMISSING;
        } else {
            try {
                if (!$access = $db->query(checkUserExistSQL())) {
                    throw new Exception("Unable to retrieve access information");
                }
                if ($row = $access->fetch_array(MYSQLI_ASSOC)) {
                    $this->status   = $row['ident'];
                    $this->requests = $row['requests_per_period'];
                    $this->period   = $row['time_period'];
                    //
                    // if requests_per_period == 0 on db, user allowed unlimited requests
                    //
                    if ($this->requests <> 0) {
                        if (!$req = $db->query(checkRequestsLimitSQL())) {
                            throw new Exception("Unable to retrieve requests information");
                        }
                        if ($row = $req->fetch_array(MYSQLI_ASSOC)) {
                            $made     = $row['reqs'];
                            if ($made >= $this->requests) {
                                $this->status = TOOMANYREQUESTS;
                            }
                        }
                    }
                } else {
                    $this->status = INCORRECTTOKENSUPPLIED;
                }
            } catch (Exception $e) {
                $this->status = DATABASEERROR;
            }
        }
    }

    function checkUserExistSQL() {
        $sql  = "SELECT ac.ident,ac.name,ac.token,ac.requests_per_period,ac.time_period,ac.created_when,ac.last_modified,ac.end_dated FROM access ac";
        $sql .= " WHERE ac.token = '".$this->token."'";
        $sql .= " AND ac.end_dated IS NULL";
        return $sql;
    }

    function checkRequestsLimitSQL() {
        $sql  = "SELECT COUNT(*) AS reqs FROM access ac LEFT JOIN request_history rh";
        $sql .= " ON ac.ident = rh.access_ident";
        $sql .= " WHERE ac.token = '".$this->token."'";
        $sql .= " AND rh.accessed > date_sub(now(), INTERVAL ".$this->period." MINUTE)";
        return $sql;
    }

    function addRequestSQL($remote, $id) {
        return "INSERT INTO request_history (remote, access_ident) VALUES ('".$remote."',".$id.")";
    }

    function getToken() {
        return $this->token;
    }

    function getStatus() {
        return $this->status;
    }

    function getRequests() {
        return $this->requests;
    }

    function getPeriod() {
        return $this->period;
    }

    function checkStatus() {

    }
}

?>
