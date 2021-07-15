<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Memory;

use GSteel\Listless\Exception\AssertionFailed;
use GSteel\Listless\Memory\MailingList;
use GSteel\Listless\Test\Stub\CaseSensitiveEmail;
use GSteel\Listless\Value\EmailAddress;
use GSteel\Listless\Value\ListId;
use PHPUnit\Framework\TestCase;

class MailingListTest extends TestCase
{
    private ListId $id;
    private MailingList $list;

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
        $this->expectException(AssertionFailed::class);
        $this->list->subscribe(
            EmailAddress::fromString('me@example.com'),
            ListId::fromString('foo')
        );
    }

    public function testSomeoneIsNotSubscribed(): void
    {
        self::assertFalse($this->list->isSubscribed(
            EmailAddress::fromString('me@example.com'),
            $this->id
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

        self::assertTrue($this->list->isSubscribed($address, $this->id));
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

        self::assertTrue($this->list->isSubscribed($lowerCaseEmail, $this->id));
        self::assertTrue($this->list->isSubscribed($mixedCaseEmail, $this->id));
    }

    public function testThatUnsubscribingSomeoneWhoIsNotSubscribedIsANoOp(): void
    {
        $email = EmailAddress::fromString('foo@example.com');
        self::assertFalse($this->list->isSubscribed($email, $this->id));
        $this->list->unsubscribe($email, $this->id);
        self::assertFalse($this->list->isSubscribed($email, $this->id));
    }

    public function testThatUnsubscribingSomeoneWhoIsSubscribedRemovesThemFromTheList(): void
    {
        $email = EmailAddress::fromString('foo@example.com');
        $this->list->subscribe($email, $this->id);
        self::assertTrue($this->list->isSubscribed($email, $this->id));
        $this->list->unsubscribe($email, $this->id);
        self::assertFalse($this->list->isSubscribed($email, $this->id));
    }

    public function testUsersAreUnsubscribedEvenWhenTheAddressIsNotLowercase(): void
    {
        $email1 = EmailAddress::fromString('foo@example.com');
        $email2 = new CaseSensitiveEmail('Foo@eXamplE.com');
        $this->list->subscribe($email1, $this->id);
        self::assertTrue($this->list->isSubscribed($email1, $this->id));
        $this->list->unsubscribe($email2, $this->id);
        self::assertFalse($this->list->isSubscribed($email1, $this->id));
    }
}
