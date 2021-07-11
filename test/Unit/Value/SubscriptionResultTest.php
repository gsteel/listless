<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\Value\SubscriptionResult;
use PHPUnit\Framework\TestCase;

class SubscriptionResultTest extends TestCase
{
    public function testThatASubscribedResultIsDeemedSuccessful(): void
    {
        self::assertTrue(SubscriptionResult::subscribed()->isSuccess());
    }

    public function testThatADuplicateResultIsDeemedUnSuccessful(): void
    {
        self::assertFalse(SubscriptionResult::duplicate()->isSuccess());
    }

    public function testThatAPendingResultIsDeemedSuccessful(): void
    {
        self::assertTrue(SubscriptionResult::pending()->isSuccess());
    }
}
