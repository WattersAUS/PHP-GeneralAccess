<?php
//
//  Module: ValidateTest.php - G.J. Watson
//    Desc: Tests for Validate
// Version: 1.00
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
}
?>
