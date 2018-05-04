<?php
//
//  Module: UserAccess.php - G.J. Watson
//    Desc: Class to check the user accessing and logging requests for the service
// Version: 1.00
//

require_once("Database.php");

final class UserAccess {

    private $token;
    private $userID;
    private $requests;
    private $period;

    private $remote;

    private $sql;

    function __construct($token) {
        $this->token    = $token;
        // default others
        $this->userID   = -1;
        $this->requests = 0;
        $this->period   = 0;
        $this->remoteIP = "";
    }

    //
    function getToken() {
        return $this->token;
    }

    function getRequests() {
        return $this->requests;
    }

    function getPeriod() {
        return $this->period;
    }

    function getRemoteIP() {
        return $this->remoteIP;
    }

    function getUserID() {
        return $this->userID;
    }

    function getLastSQL() {
        return $this->sql;
    }

    //
    function checkUserExistSQL() {
        $this->sql  = "SELECT ac.ident,ac.name,ac.token,ac.requests_per_period,ac.time_period,ac.created_when,ac.last_modified,ac.end_dated FROM access ac";
        $this->sql .= " WHERE ac.token = '".$this->token."'";
        $this->sql .= " AND ac.end_dated IS NULL";
        return $this->sql;
    }

    function checkRequestsLimitSQL() {
        $this->sql  = "SELECT COUNT(*) AS reqs FROM access ac LEFT JOIN request_history rh";
        $this->sql .= " ON ac.ident = rh.access_ident";
        $this->sql .= " WHERE ac.token = '".$this->token."'";
        $this->sql .= " AND rh.accessed > date_sub(now(), INTERVAL ".$this->period." MINUTE)";
        return $this->sql;
    }

    function checkAccessAllowed($db) {
        if (empty($this->token)) {
            throw new ServiceException(ACCESSTOKENMISSING["message"], ACCESSTOKENMISSING["code"]);
        }
        try {
            $access = $db->select($this->checkUserExistSQL());
            if ($row = $access->fetch_array(MYSQLI_ASSOC)) {
                $this->userID   = $row['ident'];
                $this->requests = $row['requests_per_period'];
                $this->period   = $row['time_period'];
                //
                // if requests_per_period == 0 on db, user allowed unlimited requests
                //
                if ($this->requests <> 0) {
                    $req = $db->select($this->checkRequestsLimitSQL());
                    if ($row = $req->fetch_array(MYSQLI_ASSOC)) {
                        $made = $row['reqs'];
                        if ($made >= $this->requests) {
                            throw new ServiceException(TOOMANYREQUESTS["message"], TOOMANYREQUESTS["code"]);
                        }  
                    }
                }
            } else {
                throw new ServiceException(INCORRECTTOKENSUPPLIED["message"], INCORRECTTOKENSUPPLIED["code"]);
            }
        } catch (mysqli_sql_exception $e) {
            throw new ServiceException(DBQUERYERROR["message"], DBQUERYERROR["code"]);
        }
    }

    function logRequest($db, $remote) {
        $this->remoteIP = $remote;
        try {
            $this->sql = "INSERT INTO request_history (remote, access_ident) VALUES ('".$this->remoteIP."',".$this->userID.")";
            $db->insert($this->sql);
        } catch (mysqli_sql_exception $e) {
            throw new ServiceException(DBQUERYERROR["message"], DBQUERYERROR["code"]);
        }
    }

}
?>
