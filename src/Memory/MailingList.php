<?php

declare(strict_types=1);

namespace GSteel\Listless\Memory;

use GSteel\Listless\Action\Subscribe;
use GSteel\Listless\Assert;
use GSteel\Listless\EmailAddress;
use GSteel\Listless\ListId;
use GSteel\Listless\MailingList as MailingListContract;
use GSteel\Listless\SubscriberInformation;
use GSteel\Listless\SubscriptionResult as ResultContract;
use GSteel\Listless\Value\SubscriptionResult;

use function array_key_exists;
use function strtolower;

final class MailingList implements MailingListContract, Subscribe
{
    /** @var ListId */
    private $id;

    /** @var array<string, EmailAddress> */
    private $members = [];

    public function __construct(
        ListId $id
    ) {
        $this->id = $id;
    }

    public function listId(): ListId
    {
        return $this->id;
    }

    public function subscribe(
        EmailAddress $address,
        ListId $listId,
        ?SubscriberInformation $subscriberInformation = null
    ): ResultContract {
        Assert::true(
            $listId->isEqualTo($this->listId()),
            'Mailing list identifier mismatch'
        );

        if ($this->isSubscribed($address)) {
            return SubscriptionResult::duplicate();
        }

        $key = strtolower($address->toString());
        $this->members[$key] = $address;

        return SubscriptionResult::subscribed();
    }

    public function isSubscribed(EmailAddress $address): bool
    {
        return array_key_exists(
            strtolower($address->toString()),
            $this->members
        );
    }
}
