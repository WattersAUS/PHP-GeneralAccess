<?php
//
//  Module: ServiceErrorTest.php - G.J. Watson
//    Desc: Tests for ServiceErrorTest
// Version: 1.00
//

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ServiceErrorTest extends TestCase {

    public function testCanBeCreatedFromValidEmailAddress(): void {
        $this->assertInstanceOf(
            ServiceError::class,
            ServiceError::fromString('user@example.com')
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress(): void {
        $this->expectException(InvalidArgumentException::class);

        Email::fromString('invalid');
    }

    public function testCanBeUsedAsString(): void {
        $this->assertEquals(
            'user@example.com',
            Email::fromString('user@example.com')
        );
    }

}

?>
