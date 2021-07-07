<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\Exception\InvalidArgument;
use GSteel\Listless\Value\ListId;
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
        $this->expectException(InvalidArgument::class);
        ListId::fromString('');
    }
}
