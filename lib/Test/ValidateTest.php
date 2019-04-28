<?php
//
//  Module: ValidateTest.php - G.J. Watson
//    Desc: Tests for Validate
// Version: 1.04
//

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once("Validate.php");

final class ValidateTest extends TestCase {

    private $validate;

    protected function setUp() {
        $this->validate = new Validate();
    }

    protected function tearDown() {
        $this->validate = NULL;
    }

    //
    // Tests for: checkVariableExistsInArray
    //
    public function testcheckVariableExistsInArrayCatchEmptyKey() {
        print("\nTEST: testcheckVariableExistsInArrayCatchEmptyKey\n");
        $this->assertEquals(FALSE, $this->validate->checkVariableExistsInArray("", array("item1","item2")));
    }

    public function testcheckVariableExistsInArrayCatchEmptyArray() {
        print("\nTEST: testcheckVariableExistsInArrayCatchEmptyArray\n");
        $this->assertEquals(FALSE, $this->validate->checkVariableExistsInArray("key", array()));
    }

    public function testcheckVariableExistsInArrayKeyNotInArray() {
        print("\nTEST: testcheckVariableExistsInArrayKeyNotInArray\n");
        $this->assertEquals(FALSE, $this->validate->checkVariableExistsInArray("key", array("item1","item2")));
    }

    public function testcheckVariableExistsInArrayKeyFoundInArray() {
        print("\nTEST: testcheckVariableExistsInArrayKeyFoundInArray\n");
        $this->assertEquals(TRUE, $this->validate->checkVariableExistsInArray("item1", array("item1" => "one","item2" => "two")));
    }


    //
    // Tests for: isValidNumeric
    //
    public function testisValidNumericNonNumericSupplied() {
        print("\nTEST: testisValidNumericNonNumericSupplied\n");
        $this->assertEquals(FALSE, $this->validate->isValidNumeric("item1"));
    }

    public function testisValidNumericNumericSupplied() {
        print("\nTEST: testisValidNumericNumericSupplied\n");
        $this->assertEquals(TRUE, $this->validate->isValidNumeric(123));
    }

    //
    // Tests for: isValidDateTime
    //
    public function testisValidDateTimeNonDateTimeSupplied() {
        print("\nTEST: testisValidDateTimeNonDateTimeSupplied\n");
        $this->assertEquals(FALSE, $this->validate->isValidDateTime("2017-02-31 16:22:39"));
    }

    public function testisValidDateTimeValidDateTimeSupplied() {
        print("\nTEST: testisValidDateTimeValidDateTimeSupplied\n");
        $this->assertEquals(TRUE, $this->validate->isValidDateTime("2017-02-28 16:22:39"));
    }

    //
    // Tests for: isValidIpAddress
    //
    public function testisValidIpAddressNonIpAddress() {
        print("\nTEST: testisValidIpAddressNonIpAddress\n");
        $this->assertEquals(FALSE, $this->validate->isValidIpAddress("192.168.0X.123"));
    }

    public function testisValidIpAddressValidIpAddress() {
        print("\nTEST: testisValidIpAddressValidIpAddress\n");
        $this->assertEquals(TRUE, $this->validate->isValidIpAddress("127.0.0.1"));
    }

    //
    // Tests for: isValidGUID
    //
    public function testisValidGUIDNonGUID() {
        print("\nTEST: testisValidGUIDNonGUID\n");
        $this->assertEquals(FALSE, $this->validate->isValidGUID("52874026-7de2-11e7Xa9d6-00163eee1df8"));
    }

    public function testisValidGUIDValidGUID() {
        print("\nTEST: testisValidIpAddressValidIpAddress\n");
        $this->assertEquals(TRUE, $this->validate->isValidGUID("52874026-7de2-11e7-a9d6-00163eee1df8"));
    }
}
?>
