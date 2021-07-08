<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Memory;

use GSteel\Listless\Exception\InvalidArgument;
use GSteel\Listless\Memory\MailingList;
use GSteel\Listless\Test\Stub\CaseSensitiveEmail;
use GSteel\Listless\Value\EmailAddress;
use GSteel\Listless\Value\ListId;
use PHPUnit\Framework\TestCase;

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
        $this->list->subscribe(
            EmailAddress::fromString('me@example.com'),
            ListId::fromString('foo')
        );
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
            EmailAddress::fromString('me@example.com'),
            $this->id
        );

        self::assertTrue($result->isSuccess());
    }

    public function testNewSubscriberIsSubscribed(): void
    {
        $address = EmailAddress::fromString('me@example.com');
        $this->list->subscribe(
            $address,
            $this->id
        );

        self::assertTrue($this->list->isSubscribed($address));
    }

    public function testSubscribingTwiceIsDuplicate(): void
    {
        $address = EmailAddress::fromString('me@example.com');

        $first = $this->list->subscribe($address, $this->id);
        $duplicate = $this->list->subscribe($address, $this->id);

        self::assertTrue($first->isSuccess());
        self::assertFalse($duplicate->isSuccess());
    }

    public function testSubscriptionStatusIgnoresCase(): void
    {
        $mixedCaseEmail = new CaseSensitiveEmail('mE@ExamplE.COM');
        $lowerCaseEmail = EmailAddress::fromString('me@example.com');

        $this->list->subscribe(
            $mixedCaseEmail,
            $this->id
        );

        self::assertTrue($this->list->isSubscribed($lowerCaseEmail));
        self::assertTrue($this->list->isSubscribed($mixedCaseEmail));
    }
}
