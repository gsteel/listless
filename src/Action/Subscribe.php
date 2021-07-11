<?php

declare(strict_types=1);

namespace GSteel\Listless\Action;

use GSteel\Listless\EmailAddress;
use GSteel\Listless\Exception\Exception;
use GSteel\Listless\ListId;
use GSteel\Listless\SubscriberInformation;
use GSteel\Listless\SubscriptionResult;

interface Subscribe
{
    /**
     * Subscribe a single email address to the given list along with optional information about the subscriber
     *
     * Implementors should throw exceptions that implement {@link Exception} if anything goes wrong.
     *
     * It should not be exceptional to subscribe an already subscribed address.
     *
     * @throws Exception
     */
    public function subscribe(
        EmailAddress $address,
        ListId $listId,
        ?SubscriberInformation $subscriberInformation = null
    ): SubscriptionResult;
}
