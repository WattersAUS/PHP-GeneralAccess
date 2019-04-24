<?php
//
//  Module: ValidateTest.php - G.J. Watson
//    Desc: Tests for Validate
// Version: 1.03
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

    public function testValidateVariableExistsEmptyKey() {
        try {
            print("\nTEST: testValidateVariableExists\n");
            $this->validate->variableExists("", "EXCEPTION: Testing Empty 'key'", 123, array("item1","item2"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testValidateVariableExistsEmptyArray() {
        try {
            print("\nTEST: testValidateVariableExistsEmptyArray\n");
            $this->validate->variableExists("key", "EXCEPTION: Testing Empty 'array'", 123, array());
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testValidateVariableExistsKeyNotInArray() {
        try {
            print("\nTEST: testValidateVariableExistsKeyNotInArray\n");
            $this->validate->variableExists("key", "EXCEPTION: Testing Key not in 'array'", 123, array("item1" => "one","item2" => "two"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testValidateVariableExistsKeyInArray() {
        try {
            print("\nTEST: testValidateVariableExistsKeyInArray\n");
            $this->validate->variableExists("item1", "EXCEPTION: Testing Key in 'array'", 123, array("item1" => "one","item2" => "two"));
            $this->assertEquals(1,   print("Key found in Array\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertNotEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testValidateNumericVariableNonNumericSupplied() {
        try {
            print("\nTEST: testValidateNumericVariable\n");
            $this->validate->numericVariable("item1", "EXCEPTION: Testing Non Numeric supplied in 'array'", 123, array("item1" => "one","item2" => "two"));
            $this->assertEquals(0,   print("We should not get here, supplying non numeric should throw exception\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }

    }

    public function testValidateNumericVariableNumericSupplied() {
        try {
            print("\nTEST: testValidateNumericVariableNumericSupplied\n");
            $this->validate->numericVariable("item1", "EXCEPTION: Testing Numeric supplied in 'array'", 123, array("item1" => 1,"item2" => 2));
            $this->assertEquals(1,   print("Supplied numeric in array\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(0,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }

    }

    public function testValidateDateTimeVariableNonDateTimeSupplied() {
        try {
            print("\nTEST: testValidateDateTimeVariableNonDateTimeSupplied\n");
            $this->validate->datetimeVariable("item1", "EXCEPTION: Testing Non DateTime supplied in 'array'", 123, array("item1" => "2017-02-31 16:22:39","item2" => 2));
            $this->assertEquals(0,   print("We should not get here, supplying non numeric should throw exception\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }

    }

    public function testValidateDateTimeVariableDateTimeSupplied() {
        try {
            print("\nTEST: testValidateDateTimeVariableNonDateTimeSupplied\n");
            $this->validate->datetimeVariable("item1", "EXCEPTION: Testing DateTime supplied in 'array'", 123, array("item1" => "2017-02-28 16:22:39","item2" => 2));
            $this->assertEquals(1,   print("Supplied datetime in array\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(0,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }

    }

    public function testValidateipAddressVariableNonipAddressSupplied() {
        try {
            print("\nTEST: testValidateipAddressVariableNonipAddressSupplied\n");
            $this->validate->ipAddressVariable("item1", "EXCEPTION: Testing Non ipAddress supplied in 'array'", 123, array("item1" => "127.0.0.1.X","item2" => 2));
            $this->assertEquals(0,   print("We should not get here, supplying non ipAddress should throw exception\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }

    }

    public function testValidateipAddressVariableipAddressSupplied() {
        try {
            print("\nTEST: testValidateipAddressVariableipAddressSupplied\n");
            $this->validate->ipAddressVariable("item1", "EXCEPTION: Testing ipAddress supplied in 'array'", 123, array("item1" => "127.0.0.1","item2" => 2));
            $this->assertEquals(1,   print("Supplied ipAddress in array\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(0,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }

    }

    public function testValidateGUIDVariableNonGUIDSupplied() {
        try {
            print("\nTEST: testValidateGUIDVariableNonGUIDSupplied\n");
            $this->validate->GUIDVariable("item1", "EXCEPTION: Testing Non GUID supplied in 'array'", 123, array("item1" => "52874026-7de2-11e7Xa9d6-00163eee1df8","item2" => 2));
            $this->assertEquals(0,   print("We should not get here, supplying non GUID should throw exception\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }

    }

    public function testValidateGUIDVariableGUIDSupplied() {
        try {
            print("\nTEST: testValidateGUIDVariableGUIDSupplied\n");
            $this->validate->GUIDVariable("item1", "EXCEPTION: Testing GUID supplied in 'array'", 123, array("item1" => "52874026-7de2-11e7-a9d6-00163eee1df8","item2" => 2));
            $this->assertEquals(1,   print("Supplied GUID in array\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(0,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print($e->getMessage()."\n");
            $this->assertNotEquals(1, $result);
        }

    }
}
?>
