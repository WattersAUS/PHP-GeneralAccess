<?php
//
//  Module: DatabaseTest.php - G.J. Watson
//    Desc: Tests for Database
// Version: 1.00
//

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once("Database.php");

final class DatabaseTest extends TestCase {

    private $db;

    protected function setUp() {
        $this->db = NULL;
    }

    protected function tearDown() {
        $this->error = NULL;
    }

    public function testDatabaseParametersWithDefaultHostSetCorrectly() {
        print("\nTEST: testDatabaseParametersWithDefaultHostSetCorrectly\n");
        $this->db = new Database("db","user","password");
        $result = strcmp("db",        $this->db->getDatabase());
        $this->assertEquals(0, $result);
        $result = strcmp("user",      $this->db->getUser());
        $this->assertEquals(0, $result);
        $result = strcmp("localhost", $this->db->getHostname());
        $this->assertEquals(0, $result);
    }

    public function testDatabaseServiceExceptionThrownCorrectly() {
        try {
            print("\nTEST: testDatabaseServiceExceptionThrownCorrectly\n");
            $this->db = new Database("dummydb","dummyuser","dummypassword");
            $this->db->connect();
            $this->assertEquals(1, 0);
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(1, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testDatabaseConnectionWorkingCorrectly() {
        try {
            print("\nTEST: testDatabaseConnectionWorkingCorrectly\n");
            $this->db = new Database("testdb","test","testpassword", "127.0.0.1");
            $this->db->connect();
            print("Yay! We connected correctly\n");
            $result = 0;
            $this->assertEquals(0, $result);
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(0, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(0, $result);
        }
    }

    public function testIncorrectSELECTCaughtCorrectly() {
        try {
            print("\nTEST: testIncorrectSELECTCaughtCorrectly\n");
            $this->db = new Database("quotes","shinyide2_user","shinyide2_user", "127.0.0.1");
            $this->db->connect();
            $this->db->select("SELECT 1 + ");
            $this->assertEquals(0, 1);
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(1, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(0, $result);
        }
    }

    public function testCorrectSELECTPassedCorrectly() {
        try {
            print("\nTEST: testIncorrectSELECTCaughtCorrectly\n");
            $this->db = new Database("quotes","shinyide2_user","shinyide2_user", "127.0.0.1");
            $this->db->connect();
            $results = $this->db->select("SELECT 1 + 1");
            if (!$results) {
                $result = print("No result set returned\n");
                $this->assertNotEquals(0, $result);
            } else {
                $result = print("Result set returned\n");
                $this->assertEquals(1, $result);
            }
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(1, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(0, $result);
        }
    }

    public function testCorrectINSERTPassedCorrectly() {
        
    }

}
?>
