<?php
//
//  Module: JsonWriterTest.php - G.J. Watson
//    Desc: Tests for JsonWriter Class
// Version: 1.01
//

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

set_include_path("../");

require_once("./objects/Author.php");
require_once("JsonBuilder.php");

final class JsonBuilderTest extends TestCase {

    private $author;

    // author setup vars
    private $testAuthor;
    private $testName;
    private $testPerd;
    private $testTime;

    //quote setup vars
    private $testQuote1;
    private $testText1;
    private $testUsed1;
    private $testQTime1;

    private $testQuote2;
    private $testText2;
    private $testUsed2;
    private $testQTime2;

    private $common;

    protected function setUp() {
        $this->testAuthor = 10;
        $this->testName   = "Author Name";
        $this->testPerd   = "Period";
        $this->testTime   = "Time";
        $this->author     = new Author($this->testAuthor, $this->testName, $this->testPerd, $this->testTime);

        // set vars for quote creation
        $this->testQuote1 = 33;
        $this->testText1  = "Quote text 1";
        $this->testUsed1  = 444;
        $this->testQTime1 = "Time 1";

        $this->testQuote2 = 44;
        $this->testText2  = "Quote text 2";
        $this->testUsed2  = 555;
        $this->testQTime2 = "Time2";

        $this->testQuote3 = 55;
        $this->testText3  = "Quote text 3";
        $this->testUsed3  = 666;
        $this->testQTime3 = "Time3";
    }

    protected function tearDown() {
        $this->builder = NULL;
    }

    public function testJsonBuilderResultJsonForAuthor() {
        print("\nTEST: testJsonBuilderResultJsonForAuthor\n");

        $version  = "v1.00";
        $service  = "testservice";
        $when     = "generatedTime";
        $name     = "author";
        $contents = $this->author->getAuthorAsArray();

        $expected = "{\"version\":\"v1.00\",\"service\":\"testservice\",\"generated\":\"generatedTime\",\"author\":{\"author_id\":10,\"author_name\":\"Author Name\",\"author_period\":\"Period\",\"added\":\"Time\"}}";

        $builder  = new JsonBuilder($version, $service, $when, $name, $contents);
        $json     = $builder->getJson();
        $this->assertEquals(0, strcmp($json, $expected));
    }

    public function testJsonBuilderResultJsonForAuthorAllQuotes() {
        print("\nTEST: testJsonBuilderResultJsonForAuthorAllQuotes\n");

        $version  = "v1.01";
        $service  = "testservice2";
        $when     = "generatedTime2";
        $name     = "author2";
        $quote1   = new Quote($this->testQuote1, $this->testText1, $this->testUsed1, $this->testQTime1);
        $this->author->addQuote($quote1);
        $quote2   = new Quote($this->testQuote2, $this->testText2, $this->testUsed2, $this->testQTime2);
        $this->author->addQuote($quote2);
        $contents = $this->author->getAuthorWithAllQuotesAsArray();

        $expected = "{\"version\":\"v1.01\",\"service\":\"testservice2\",\"generated\":\"generatedTime2\",\"author2\":{\"author_id\":10,\"author_name\":\"Author Name\",\"author_period\":\"Period\",\"added\":\"Time\",\"quotes\":[{\"quote_id\":33,\"quote_text\":\"Quote text 1\",\"times_used\":444,\"added\":\"Time 1\"},{\"quote_id\":44,\"quote_text\":\"Quote text 2\",\"times_used\":555,\"added\":\"Time2\"}]}}";

        $builder  = new JsonBuilder($version, $service, $when, $name, $contents);
        $json     = $builder->getJson();
        $this->assertEquals(0, strcmp($json, $expected));
    }

    public function testJsonBuilderResultJsonForAuthorRandomQuote() {
        print("\nTEST: testJsonBuilderResultJsonForAuthorRandomQuote\n");

        $version  = "v1.02";
        $service  = "testservice3";
        $when     = "generatedTime3";
        $name     = "author3";
        $quote1   = new Quote($this->testQuote3, $this->testText3, $this->testUsed3, $this->testQTime3);
        $this->author->addQuote($quote1);
        $contents = $this->author->getAuthorWithSelectedQuoteAsArray(0);

        $expected = "{\"version\":\"v1.02\",\"service\":\"testservice3\",\"generated\":\"generatedTime3\",\"author3\":{\"author_id\":10,\"author_name\":\"Author Name\",\"author_period\":\"Period\",\"added\":\"Time\",\"quote\":{\"quote_id\":55,\"quote_text\":\"Quote text 3\",\"times_used\":666,\"added\":\"Time3\"}}}";

        $builder  = new JsonBuilder($version, $service, $when, $name, $contents);
        $json     = $builder->getJson();
        $this->assertEquals(0, strcmp($json, $expected));
    }
}
?>
