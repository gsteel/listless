<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\Value\EmailAddress;
use GSteel\Listless\Value\ListId;
use GSteel\Listless\Value\SubscriptionRequest;
use PHPUnit\Framework\TestCase;

class SubscriptionRequestTest extends TestCase
{
    /** @var EmailAddress */
    private $email;
    /** @var ListId */
    private $list;
    /** @var SubscriptionRequest */
    private $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->email = EmailAddress::fromString('me@example.com', 'Me');
        $this->list = ListId::fromString('some-list');
        $this->request = SubscriptionRequest::new($this->email, $this->list);
    }

    public function testTheEmailIsTheSame(): void
    {
        self::assertTrue($this->request->emailAddress()->isEqualTo($this->email));
    }

    public function testThatTheListIdIsTheSame(): void
    {
        self::assertTrue($this->request->listId()->isEqualTo($this->list));
    }
}
