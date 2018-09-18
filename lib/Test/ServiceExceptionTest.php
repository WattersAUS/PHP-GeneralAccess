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
    
    public function testServiceExceptionDBCONNECTERRORThrownCorrectly() {
        try {
            print("\nTesting ServiceException DBCONNECTERROR error is thrown and caught correctly\n");
            throw new ServiceException(DBCONNECTERROR["message"], DBCONNECTERROR["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(500, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("500 Internal Server Error", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionDBQUERYERRORThrownCorrectly() {
        try {
            print("\nTesting ServiceException DBQUERYERROR error is thrown and caught correctly\n");
            throw new ServiceException(DBQUERYERROR["message"], DBQUERYERROR["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(500, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("500 Internal Server Error", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionDBINSERTERRORThrownCorrectly() {
        try {
            print("\nTesting ServiceException DBINSERTERROR error is thrown and caught correctly\n");
            throw new ServiceException(DBINSERTERROR["message"], DBINSERTERROR["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(500, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("500 Internal Server Error", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionDBUPDATEERRORThrownCorrectly() {
        try {
            print("\nTesting ServiceException DBUPDATEERROR error is thrown and caught correctly\n");
            throw new ServiceException(DBUPDATEERROR["message"], DBUPDATEERROR["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(500, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("500 Internal Server Error", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionHTTPMETHODERRORThrownCorrectly() {
        try {
            print("\nTesting ServiceException HTTPMETHODERROR error is thrown and caught correctly\n");
            throw new ServiceException(HTTPMETHODERROR["message"], HTTPMETHODERROR["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(501, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("501 Not Implemented", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionHTTPSUPPORTERRORThrownCorrectly() {
        try {
            print("\nTesting ServiceException HTTPSUPPORTERROR error is thrown and caught correctly\n");
            throw new ServiceException(HTTPSUPPORTERROR["message"], HTTPSUPPORTERROR["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(501, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("501 Not Implemented", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionHTTPROUTINGERRORThrownCorrectly() {
        try {
            print("\nTesting ServiceException HTTPROUTINGERROR error is thrown and caught correctly\n");
            throw new ServiceException(HTTPROUTINGERROR["message"], HTTPROUTINGERROR["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(501, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("501 Not Implemented", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionMALFORMEDREQUESTThrownCorrectly() {
        try {
            print("\nTesting ServiceException MALFORMEDREQUEST error is thrown and caught correctly\n");
            throw new ServiceException(MALFORMEDREQUEST["message"], MALFORMEDREQUEST["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(500, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("500 Internal Server Error", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionACCESSTOKENMISSINGThrownCorrectly() {
        try {
            print("\nTesting ServiceException ACCESSTOKENMISSING error is thrown and caught correctly\n");
            throw new ServiceException(ACCESSTOKENMISSING["message"], ACCESSTOKENMISSING["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(401, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("401 Unauthorized", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionINCORRECTTOKENSUPPLIEDThrownCorrectly() {
        try {
            print("\nTesting ServiceException INCORRECTTOKENSUPPLIED error is thrown and caught correctly\n");
            throw new ServiceException(INCORRECTTOKENSUPPLIED["message"], INCORRECTTOKENSUPPLIED["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(401, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("401 Unauthorized", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionACCESSDENIEDThrownCorrectly() {
        try {
            print("\nTesting ServiceException ACCESSDENIED error is thrown and caught correctly\n");
            throw new ServiceException(ACCESSDENIED["message"], ACCESSDENIED["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(403, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("403 Forbidden", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionTOOMANYREQUESTSThrownCorrectly() {
        try {
            print("\nTesting ServiceException TOOMANYREQUESTS error is thrown and caught correctly\n");
            throw new ServiceException(TOOMANYREQUESTS["message"], TOOMANYREQUESTS["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(429, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("429 Too Many Requests", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionTOKENEXPIREDThrownCorrectly() {
        try {
            print("\nTesting ServiceException TOKENEXPIRED error is thrown and caught correctly\n");
            throw new ServiceException(TOKENEXPIRED["message"], TOKENEXPIRED["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(403, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("403 Forbidden", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionUNKNOWNERRORThrownCorrectly() {
        try {
            print("\nTesting ServiceException UNKNOWNERROR error is thrown and caught correctly\n");
            throw new ServiceException(UNKNOWNERROR["message"], UNKNOWNERROR["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(500, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("500 Internal Server Error", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionILLEGALLOTTERYIDThrownCorrectly() {
        try {
            print("\nTesting ServiceException ILLEGALLOTTERYID error is thrown and caught correctly\n");
            throw new ServiceException(ILLEGALLOTTERYID["message"], ILLEGALLOTTERYID["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(400, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("400 Bad Request", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionILLEGALDRAWCOUNTThrownCorrectly() {
        try {
            print("\nTesting ServiceException ILLEGALDRAWCOUNT error is thrown and caught correctly\n");
            throw new ServiceException(ILLEGALDRAWCOUNT["message"], ILLEGALDRAWCOUNT["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(406, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("406 Not Acceptable", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionILLEGALAUTHORIDThrownCorrectly() {
        try {
            print("\nTesting ServiceException ILLEGALAUTHORID error is thrown and caught correctly\n");
            throw new ServiceException(ILLEGALAUTHORID["message"], ILLEGALAUTHORID["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(400, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("400 Bad Request", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionACTIVEAUTHORNOTFOUNDThrownCorrectly() {
        try {
            print("\nTesting ServiceException ACTIVEAUTHORNOTFOUND error is thrown and caught correctly\n");
            throw new ServiceException(ACTIVEAUTHORNOTFOUND["message"], ACTIVEAUTHORNOTFOUND["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(404, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("404 Not Found", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionAUTHORNOQUOTESThrownCorrectly() {
        try {
            print("\nTesting ServiceException AUTHORNOQUOTES error is thrown and caught correctly\n");
            throw new ServiceException(AUTHORNOQUOTES["message"], AUTHORNOQUOTES["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(404, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("404 Not Found", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionILLEGALDATEThrownCorrectly() {
        try {
            print("\nTesting ServiceException ILLEGALDATE error is thrown and caught correctly\n");
            throw new ServiceException(ILLEGALDATE["message"], ILLEGALDATE["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(406, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("406 Not Acceptable", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

    public function testServiceExceptionFILENOTFOUNDThrownCorrectly() {
        try {
            print("\nTesting ServiceException FILENOTFOUND error is thrown and caught correctly\n");
            throw new ServiceException(FILENOTFOUND["message"], FILENOTFOUND["code"]);
        } catch (ServiceException $e) {
            // Should be caught here
            $this->assertEquals(400, $e->getHTMLResponseCode());
            $this->assertEquals(0,   strcmp("400 Bad Request", $e->getHTMLResponseMsg()));
            $this->assertEquals(1,   print($e->jsonString()));
        } catch (Exception $e) {
            // And not here
            $result = print("Caught as normal exception!");
            $this->assertNotEquals(1, $result);
        }
    }

}
?>