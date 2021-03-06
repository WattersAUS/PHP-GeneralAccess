<?php
//
//  Module: JsonBuilder.php - G.J. Watson
//    Desc: Json Object Builder
// Version: 1.02
//

require_once("Common.php");

final class JsonBuilder {
    private $version;
    private $service;
    private $when;
    private $name;
    private $contents;

    public function __construct($version, $service, $when, $name, $contents) {
        $this->version  = $version;
        $this->service  = $service;
        $this->when     = $when;
        $this->name     = $name;
        $this->contents = $contents;
    }

    public function getJson() {
        $output["version"]   = $this->version;
        $output["service"]   = $this->service;
        $output["generated"] = $this->when;
        $output[$this->name] = $this->contents;
        return json_encode($output, JSON_NUMERIC_CHECK);
    }

}
?>
