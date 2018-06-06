<?php
//
//  Module: UserAccessTest.php - G.J. Watson
//    Desc: Tests for User Access validation and logging code
// Version: 1.00
//

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once("ServiceException.php");
require_once("Database.php");
require_once("UserAccess.php");

final class UserAccessTest extends TestCase {

    private $db;
    private $access;

    protected function setUp() {
        try {
            print("\nConnecting to the test database\n");
            $this->db = new Database("quotes","shinyide2_user","shinyide2_user", "127.0.0.1");
            $this->db->connect();
            $result = print("Yay! We connected correctly\n");
            $this->assertEquals(1, $result);
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(0, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertEquals(0, $result);
        }
    }

    protected function tearDown() {
        $this->db->close();
    }

    public function testNonExistentTokenRaisesError() {
        $this->access = new UserAccess("dummy-token");
        try {
            print("Checking token exists: ".$this->access->getToken()."\n");
            $this->access->checkAccessAllowed($this->db);
            $result = print("We shouldn't get here as the token doesn't exist!");
            $this->assertEquals(0, $result);
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(1, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertEquals(0, $result);
        }
    }

    public function testActualUnrestrictedTokenIsAllowedAccess() {
        $this->access = new UserAccess("52874026-7de2-11e7-a9d6-00163eee1df8");
        try {
            print("Checking token exists: ".$this->access->getToken()."\n");
            $this->access->checkAccessAllowed($this->db);
            $result = print("We should be here, as the token exists!");
            $this->assertEquals(1, $result);
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(0, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertEquals(0, $result);
        }
    }

    public function testUserAccessLogRequestWorks() {
        $token  = "934d0c1b-7de2-11e7-a9d6-00163eee1df8";
        $testip = "test-ip-addr";
        $ident  = 2;
        $this->access = new UserAccess($token);
        try {
            print("Logging request with token: ".$token."\n");
            $this->access->logRequest($this->db, $testip, $ident);
            $result = 0;
            $this->assertEquals(0, $result);
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(0, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertEquals(0, $result);
        }
    }

    public function testActualRestrictedTokenIsRaisesError() {
        $this->access = new UserAccess("934d0c1b-7de2-11e7-a9d6-00163eee1df8");
        try {
            print("Checking existing token to populate class members for subsequent calls: ".$this->access->getToken()."\n");
            $this->access->checkAccessAllowed($this->db);
            print("Logging access to use up access count: ".$this->access->getToken()."\n");
            $testip = "1st access";
            $ident  = 2;
            $this->access->logRequest($this->db, $testip, $ident);
            $testip = "2nd access";
            $this->access->logRequest($this->db, $testip, $ident);
            $testip = "3rd access";
            $this->access->logRequest($this->db, $testip, $ident);
            $testip = "4th access";
            $this->access->logRequest($this->db, $testip, $ident);
            $testip = "5th access";
            $this->access->logRequest($this->db, $testip, $ident);
            $testip = "6th access";
            $this->access->logRequest($this->db, $testip, $ident);
            // now we should get rejected as the number of accesses should be used up!
            print("Checking token that should exceed usage: ".$this->access->getToken()."\n");
            $this->access->checkAccessAllowed($this->db);
            $result = print("We shouldn't get here, as the number of accesses should exceed usage level!");
            $this->assertEquals(0, $result);
        } catch (ServiceException $e) {
            // Should be caught here
            $result = print($e->jsonString());
            $this->assertEquals(1, $result);
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertEquals(0, $result);
        }
    }

}
?>
