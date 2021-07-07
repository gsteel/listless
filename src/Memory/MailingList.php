<?php

declare(strict_types=1);

namespace GSteel\Listless\Memory;

use GSteel\Listless\Action\Subscribe;
use GSteel\Listless\Assert;
use GSteel\Listless\EmailAddress;
use GSteel\Listless\ListId;
use GSteel\Listless\MailingList as MailingListContract;
use GSteel\Listless\SubscriptionRequest;
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

    public function subscribe(SubscriptionRequest $request): ResultContract
    {
        Assert::true(
            $request->listId()->isEqualTo($this->listId()),
            'Mailing list identifier mismatch'
        );

        if ($this->isSubscribed($request->emailAddress())) {
            return SubscriptionResult::duplicate($request);
        }

        $key = strtolower($request->emailAddress()->toString());
        $this->members[$key] = $request->emailAddress();

        return SubscriptionResult::subscribed($request);
    }

    public function isSubscribed(EmailAddress $address): bool
    {
        return array_key_exists(
            strtolower($address->toString()),
            $this->members
        );
    }
}
