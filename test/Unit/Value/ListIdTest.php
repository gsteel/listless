<?php

declare(strict_types=1);

namespace ListInterop\Test\Unit\Value;

use ListInterop\Exception\AssertionFailed;
use ListInterop\Value\ListId;
use PHPUnit\Framework\TestCase;

class ListIdTest extends TestCase
{
    public function testThatTwoDifferentListIdentifiersCanBeEqual(): void
    {
        self::assertTrue(
            ListId::fromString('foo')->isEqualTo(
                ListId::fromString('foo')
            )
        );
    }

    public function testThatListIdentifiersAreCaseSensitive(): void
    {
        self::assertFalse(
            ListId::fromString('foo')->isEqualTo(
                ListId::fromString('FOO')
            )
        );
    }

    public function testThatAnEmptyListIdIsNotOK(): void
    {
        $this->expectException(AssertionFailed::class);
        ListId::fromString('');
    }
}
