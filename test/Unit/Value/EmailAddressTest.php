<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\Exception\InvalidArgument;
use GSteel\Listless\Test\Stub\CaseSensitiveEmail;
use GSteel\Listless\Value\EmailAddress;
use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase
{
    public function testAnInvalidAddressIsExceptional(): void
    {
        $this->expectException(InvalidArgument::class);
        EmailAddress::fromString('foo');
    }

    public function testAnEmptyDisplayNameIsExceptional(): void
    {
        $this->expectException(InvalidArgument::class);
        EmailAddress::fromString('foo@example.com', '');
    }

    public function testWhatGoesInComesOut(): void
    {
        $email = EmailAddress::fromString('crusher@example.com', 'Beverly Crusher');

        self::assertEquals('crusher@example.com', $email->toString());
        self::assertEquals('Beverly Crusher', $email->displayName());
    }

    public function testCastingToString(): void
    {
        $email = EmailAddress::fromString('jim@example.com');

        self::assertEquals('jim@example.com', (string) $email);
    }

    public function testThatComparisonIsCaseInSensitive(): void
    {
        self::assertTrue(
            EmailAddress::fromString('ME@example.COM')->isEqualTo(
                new CaseSensitiveEmail('me@Example.Com')
            )
        );
    }

    public function testThatDifferentEmailsAreNotTheSame(): void
    {
        self::assertFalse(
            EmailAddress::fromString('me@example.com')->isEqualTo(
                EmailAddress::fromString('them@example.com')
            )
        );
    }
}
