<?php
//
//  Module: Common.php - G.J. Watson
//    Desc: Contains modules to use through out scripts
// Version: 2.00
//

final class Common {

 	function __construct() {
    }

    static function getGeneratedDate() {
        return date("Y-m-d");
    }

    static function getGeneratedDateTime() {
        return date("Y-m-d H:i:s");
    }

    function jsonFilename($workspace, $filename) {
        return $workspace.getGeneratedDate()."_".$filename;
    }
}
?>
