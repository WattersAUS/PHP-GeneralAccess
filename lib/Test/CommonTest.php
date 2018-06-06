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

    private $datePattern = "/\d{4}-\d{2}-\d{2} \d{2}:\d{2}/";
    private $timePattern = "/(2[0-3]|[0][0-9]|1[0-9]):([0-5][0-9])/";

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

    public function testINFOMessageReturnsString() {
        $message = $this->common->logINFOMessage("This is a test message");
        print("\nChecking INFO message = ".$message);
        $result = FALSE;
        if (preg_match($this->datePattern, $message) == 1) {
            print("Passed date check in message\n");
            if (preg_match($this->timePattern, $message) == 1) {
                print("Passed date check in message\n");
                if (preg_match("/INFO/", $message) == 1) {
                    print("Passed INFO type check in message\n");
                    $result = TRUE;
                } else {
                    print("\nFailed INFO type check in message!!!!\n");
                }
            } else {
                print("\nFailed time check in message looking for HH:MM format!!!!\n");
            }
        } else {
            print("\nFailed date check in message looking for YYYY-MM-DD format!!!!\n");

        }
        $this->assertEquals(TRUE, $result);
    }

    public function testDEBUGMessageReturnsString() {
        $message = $this->common->logDEBUGMessage("This is a test message");
        print("\nChecking DEBUG message = ".$message);
        $result = FALSE;
        if (preg_match($this->datePattern, $message)) {
            print("Passed date check in message\n");
            if (preg_match($this->timePattern, $message)) {
                print("Passed date check in message\n");
                if (preg_match("/DEBUG/", $message)) {
                    print("Passed DEBUG type check in message\n");
                    $result = TRUE;
                } else {
                    print("\nFailed DEBUG type check in message!!!!\n");
                }
            } else {
                print("\nFailed time check in message looking for HH:MM format!!!!\n");
            }
        } else {
            print("\nFailed date check in message looking for YYYY-MM-DD format!!!!\n");

        }
        $this->assertEquals(TRUE, $result);
    }

    public function testERRORMessageReturnsString() {
        $message = $this->common->logERRORMessage("This is a test message");
        print("\nChecking ERROR message = ".$message);
        $result = FALSE;
        if (preg_match($this->datePattern, $message)) {
            print("Passed date check in message\n");
            if (preg_match($this->timePattern, $message)) {
                print("Passed date check in message\n");
                if (preg_match("/ERROR/", $message)) {
                    print("Passed ERROR type check in message\n");
                    $result = TRUE;
                } else {
                    print("\nFailed ERROR type check in message!!!!\n");
                }
            } else {
                print("\nFailed time check in message looking for HH:MM format!!!!\n");
            }
        } else {
            print("\nFailed date check in message looking for YYYY-MM-DD format!!!!\n");

        }
        $this->assertEquals(TRUE, $result);
    }
}

?>
