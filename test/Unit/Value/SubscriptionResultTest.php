<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\Value\EmailAddress;
use GSteel\Listless\Value\ListId;
use GSteel\Listless\Value\SubscriptionRequest;
use GSteel\Listless\Value\SubscriptionResult;
use PHPUnit\Framework\TestCase;

class SubscriptionResultTest extends TestCase
{
    /** @var SubscriptionRequest */
    private $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = SubscriptionRequest::new(
            EmailAddress::fromString('me@example.com'),
            ListId::fromString('foo')
        );
    }

    public function testThatTheRequestIsTheSameInstance(): void
    {
        self::assertSame($this->request, SubscriptionResult::subscribed($this->request)->request());
    }

    public function testThatASubscribedResultIsDeemedSuccessful(): void
    {
        self::assertTrue(SubscriptionResult::subscribed($this->request)->isSuccess());
    }

    public function testThatADuplicateResultIsDeemedUnSuccessful(): void
    {
        self::assertFalse(SubscriptionResult::duplicate($this->request)->isSuccess());
    }
}
