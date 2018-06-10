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

    private $quotedb;
    private $quoteuser;
    private $quotepwd;
    private $quoteip;

    protected function setUp() {
        $this->db        = NULL;
        $this->quotedb   = "quotes";
        $this->quoteuser = "shinyide2_user";
        $this->quotepwd  = "shinyide2_user";
        $this->quoteip   = "127.0.0.1";
    }

    protected function tearDown() {
        $this->error = NULL;
    }

    public function testDatabaseParametersWithDefaultHostSetCorrectly() {
        print("\n\nTEST: testDatabaseParametersWithDefaultHostSetCorrectly\n");
        $this->db = new Database("db","user","password");
        $this->assertEquals(0, strcmp("db", $this->db->getDatabase()));
        $this->assertEquals(0, strcmp("user", $this->db->getUser()));
        $this->assertEquals(0, strcmp("localhost", $this->db->getHostname()));
    }

    public function testDatabaseServiceExceptionThrownCorrectly() {
        try {
            print("\n\nTEST: testDatabaseServiceExceptionThrownCorrectly\n");
            $this->db = new Database("dummydb","dummyuser","dummypassword");
            $this->db->connect();
            $this->assertEquals(1, 0);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1, print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $this->assertNotEquals(1, print("Incorrectly caught as normal exception!"));
        }
    }

    public function testDatabaseConnectionWorkingCorrectly() {
        try {
            print("\n\nTEST: testDatabaseConnectionWorkingCorrectly\n");
            $this->db = new Database("testdb","test","testpassword", $this->quoteip);
            $this->db->connect();
            $this->assertNotEquals(0, print("Yay! We connected correctly\n"));
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(0, print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $this->assertNotEquals(0, print("Incorrectly caught as normal exception!"));
        }
    }

    public function testIncorrectSELECTCaughtCorrectly() {
        try {
            print("\n\nTEST: testIncorrectSELECTCaughtCorrectly\n");
            $this->db = new Database($this->quotedb,$this->quoteuser,$this->quotepwd, $this->quoteip);
            $this->db->connect();
            $this->db->select("SELECT 1 + ");
            $this->assertEquals(0, 1);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1, print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $this->assertEquals(0, print("Incorrectly caught SELECT error as normal exception!"));
        }
    }

    public function testCorrectSELECTPassedCorrectly() {
        try {
            print("\n\nTEST: testIncorrectSELECTCaughtCorrectly\n");
            $this->db = new Database($this->quotedb,$this->quoteuser,$this->quotepwd, $this->quoteip);
            $this->db->connect();
            $results = $this->db->select("SELECT 1 + 1");
            if (!$results) {
                $this->assertNotEquals(0, print("No result set returned\n"));
            } else {
                $this->assertEquals(1, print("Result set returned\n"));
            }
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1, print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $this->assertEquals(0, print("Incorrectly caught SELECT error as normal exception!"));
        }
    }

    public function testInCorrectINSERTPassedCorrectly() {
        try {
            print("\n\nTEST: testInCorrectINSERTPassedCorrectly\n");
            $this->db = new Database($this->quotedb,$this->quoteuser,$this->quotepwd, $this->quoteip);
            $this->db->connect();
            $this->db->insert("SELECT 1 + ");
            $this->assertEquals(0, 1);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1, print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $this->assertEquals(0, print("Incorrectly caught INSERT error as normal exception!"));
        }
    }

    public function testCorrectINSERTPassedCorrectly() {
        try {
            print("\n\nTEST: testCorrectINSERTPassedCorrectly\n");
            $this->db = new Database($this->quotedb,$this->quoteuser,$this->quotepwd, $this->quoteip);
            $this->db->connect();
            $results = $this->db->insert("SELECT 1 + 1");
            if (!$results) {
                $this->assertNotEquals(0, print("No result set returned\n"));
            } else {
                $this->assertEquals(1, print("Result set returned\n"));
            }
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1, print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $this->assertEquals(0, print("Incorrectly caught INSERT error as normal exception!"));
        }
    }

    public function testInCorrectUPDATEPassedCorrectly() {
        try {
            print("\n\nTEST: testInCorrectUPDATEPassedCorrectly\n");
            $this->db = new Database($this->quotedb,$this->quoteuser,$this->quotepwd, $this->quoteip);
            $this->db->connect();
            $this->db->update("SELECT 1 + ");
            $this->assertEquals(0, 1);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1, print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $this->assertEquals(0, print("Incorrectly caught UPDATE error as normal exception!"));
        }
    }

    public function testCorrectUPDATEPassedCorrectly() {
        try {
            print("\n\nTEST: testCorrectUPDATEPassedCorrectly\n");
            $this->db = new Database($this->quotedb,$this->quoteuser,$this->quotepwd, $this->quoteip);
            $this->db->connect();
            $results = $this->db->update("SELECT 1 + 1");
            if (!$results) {
                $this->assertNotEquals(0, print("No result set returned\n"));
            } else {
                $this->assertEquals(1, print("Result set returned\n"));
            }
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(1, print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $this->assertEquals(0, print("Incorrectly caught UPDATE error as normal exception!"));
        }
    }
}
?>
