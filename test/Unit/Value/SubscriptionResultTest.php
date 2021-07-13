<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\SubscriptionResult as Result;
use GSteel\Listless\Value\SubscriptionResult;
use PHPUnit\Framework\TestCase;

class SubscriptionResultTest extends TestCase
{
    public function testStatesThatShouldBeDeemedSuccessful(): void
    {
        $results = [
            SubscriptionResult::subscribed(),
            SubscriptionResult::pending(),
            SubscriptionResult::submitted(),
        ];

        foreach ($results as $result) {
            self::assertTrue($result->isSuccess());
        }
    }

    public function testStatesThatShouldBeDeemedUnsuccessful(): void
    {
        $results = [
            SubscriptionResult::error(),
            SubscriptionResult::duplicate(),
            SubscriptionResult::rejected(),
        ];

        foreach ($results as $result) {
            self::assertFalse($result->isSuccess());
        }
    }

    public function testThatEqualityCanBeDetermined(): void
    {
        self::assertFalse(SubscriptionResult::pending()->equals(SubscriptionResult::duplicate()));
        self::assertTrue(SubscriptionResult::duplicate()->equals(SubscriptionResult::duplicate()));
    }

    /** @return array<array-key, array{0: int, 1: SubscriptionResult}> */
    public function resultProvider(): array
    {
        return [
            [Result::SUBSCRIBED, SubscriptionResult::subscribed()],
            [Result::SUBMITTED, SubscriptionResult::submitted()],
            [Result::DUPLICATE, SubscriptionResult::duplicate()],
            [Result::REJECTED, SubscriptionResult::rejected()],
            [Result::ERROR, SubscriptionResult::error()],
            [Result::PENDING, SubscriptionResult::pending()],
        ];
    }

    /** @dataProvider resultProvider */
    public function testThatTheResultCodeHasTheExpectedValue(int $expect, SubscriptionResult $result): void
    {
        self::assertEquals($expect, $result->resultCode());
    }
}
