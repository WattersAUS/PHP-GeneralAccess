<?php
//
// Module: LogRequest.php - G.J. Watson
//

function logRequest($db, $remote_addr, $id) {
    try {
        if ($db->query(insertRemoteRequest($remote_addr, $id)) != TRUE) {
            throw new Exception("Unable to log request");
        }
    } catch (Exception $e) {
    }
    return;
}
?>
