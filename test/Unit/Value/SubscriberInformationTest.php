<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\Exception\InvalidArgument;
use GSteel\Listless\Value\SubscriberInformation;
use PHPUnit\Framework\TestCase;
use stdClass;

class SubscriberInformationTest extends TestCase
{
    /**
     * @test
     * @psalm-suppress InvalidArgument
     */
    public function nonScalarValuesShouldBeExceptional(): void
    {
        $this->expectException(InvalidArgument::class);
        SubscriberInformation::fromArray([new stdClass()]);
    }

    /** @test */
    public function dataShouldBeStoredUnmodified(): void
    {
        $input = [
            'mushrooms' => 'goats',
            'fruits' => [
                'apples',
                'pears',
            ],
        ];

        $info = SubscriberInformation::fromArray($input);

        self::assertEquals($input, $info->toArray());
    }
}
