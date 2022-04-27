<?php

declare(strict_types=1);

namespace ListInterop\Memory;

use ListInterop\Action\IsSubscribed;
use ListInterop\Action\Subscribe;
use ListInterop\Action\Unsubscribe;
use ListInterop\Assert;
use ListInterop\EmailAddress;
use ListInterop\ListId;
use ListInterop\MailingList as MailingListContract;
use ListInterop\SubscriberInformation;
use ListInterop\SubscriptionResult as ResultContract;
use ListInterop\Value\SubscriptionResult;

use function array_key_exists;
use function strtolower;

/**
 * @internal
 */
final class MailingList implements MailingListContract, Subscribe, IsSubscribed, Unsubscribe
{
    private ListId $id;

    /** @var array<string, EmailAddress> */
    private array $members;

    public function __construct(
        ListId $id
    ) {
        $this->id = $id;
        $this->members = [];
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

        if ($this->isSubscribed($address, $listId)) {
            return SubscriptionResult::duplicate();
        }

        $key = strtolower($address->toString());
        $this->members[$key] = $address;

        return SubscriptionResult::subscribed();
    }

    public function isSubscribed(EmailAddress $address, ListId $listId): bool
    {
        return array_key_exists(
            strtolower($address->toString()),
            $this->members
        );
    }

    public function unsubscribe(EmailAddress $address, ListId $fromList): void
    {
        if (! $this->isSubscribed($address, $fromList)) {
            return;
        }

        unset($this->members[strtolower($address->toString())]);
    }
}
