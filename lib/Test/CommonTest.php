<?php
//
//  Module: CommonTest.php - G.J. Watson
//    Desc: Tests for Common
// Version: 1.00
//

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once("Common.php");

final class CommonTest extends TestCase {

    private $common;

    protected function setUp() {
        $this->common = new Common();
    }

    protected function tearDown() {
        $this->common = NULL;
    }

    // test the code and message are set correctly on the constructor
    public function testCommonGetGeneratedDateReturnsString() {
        $date = $this->common->getGeneratedDate();
        print("\nChecking date string returned: ".$date."\n");
        $result = is_string($date);
        $this->assertEquals(TRUE, $result);
    }

    public function testCommonGetGeneratedDateTimeReturnsString() {
        $dateTime = $this->common->getGeneratedDateTime();
        print("\nChecking date time string returned: ".$dateTime."\n");
        $result = is_string($dateTime);
        $this->assertEquals(TRUE, $result);
    }
}

?>
