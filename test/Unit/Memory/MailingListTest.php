<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Memory;

use GSteel\Listless\Exception\InvalidArgument;
use GSteel\Listless\Memory\MailingList;
use GSteel\Listless\Test\Stub\CaseSensitiveEmail;
use GSteel\Listless\Value\EmailAddress;
use GSteel\Listless\Value\ListId;
use GSteel\Listless\Value\SubscriptionRequest;
use GSteel\Listless\Value\SubscriptionResult;
use PHPUnit\Framework\TestCase;

use function assert;

class MailingListTest extends TestCase
{
    /** @var ListId */
    private $id;
    /** @var MailingList */
    private $list;

    protected function setUp(): void
    {
        parent::setUp();
        $this->id = ListId::fromString('list');
        $this->list = new MailingList($this->id);
    }

    public function testTheListIdIsTheExpectedValue(): void
    {
        self::assertTrue($this->list->listId()->isEqualTo($this->id));
    }

    public function testListIdMismatchInSubscribe(): void
    {
        $this->expectException(InvalidArgument::class);
        $this->list->subscribe(SubscriptionRequest::new(
            EmailAddress::fromString('me@example.com'),
            ListId::fromString('foo')
        ));
    }

    public function testSomeoneIsNotSubscribed(): void
    {
        self::assertFalse($this->list->isSubscribed(
            EmailAddress::fromString('me@example.com')
        ));
    }

    public function testNewSubscriberIsSuccess(): void
    {
        $result = $this->list->subscribe(
            SubscriptionRequest::new(
                EmailAddress::fromString('me@example.com'),
                $this->id
            )
        );
        assert($result instanceof SubscriptionResult);
        self::assertTrue($result->isSuccess());
    }

    public function testNewSubscriberIsSubscribed(): void
    {
        $result = $this->list->subscribe(
            SubscriptionRequest::new(
                EmailAddress::fromString('me@example.com'),
                $this->id
            )
        );
        self::assertTrue($this->list->isSubscribed($result->request()->emailAddress()));
    }

    public function testSubscribingTwiceIsDuplicate(): void
    {
        $request = SubscriptionRequest::new(
            EmailAddress::fromString('me@example.com'),
            $this->id
        );

        $first = $this->list->subscribe($request);
        $duplicate = $this->list->subscribe($request);
        assert($first instanceof SubscriptionResult);
        assert($duplicate instanceof SubscriptionResult);

        self::assertTrue($first->isSuccess());
        self::assertFalse($duplicate->isSuccess());
    }

    public function testSubscriptionStatusIgnoresCase(): void
    {
        $email = new CaseSensitiveEmail('mE@ExamplE.COM');
        $this->list->subscribe(SubscriptionRequest::new(
            $email,
            $this->id
        ));

        self::assertTrue($this->list->isSubscribed(EmailAddress::fromString('me@example.com')));
        self::assertTrue($this->list->isSubscribed($email));
    }
}
