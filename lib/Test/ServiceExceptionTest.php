<?php
//
//  Module: ServiceExceptionTest.php - G.J. Watson
//    Desc: Tests for ServiceException
// Version: 1.00
//

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once("ServiceException.php");

final class ServiceExceptionTest extends TestCase {

    private $error;

    protected function setUp() {
        $this->error = "";
    }

    protected function tearDown() {
        $this->error = NULL;
    }

    public function testServiceExceptionThrownCorrectly() {
        try {
            print("\nTesting ServiceException ACCESSDENIED error is thrown and caught correctly\n");
            throw new ServiceException(ACCESSDENIED["message"], ACCESSDENIED["code"]);
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

}
?>
