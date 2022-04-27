<?php

declare(strict_types=1);

namespace ListInterop\Action;

use ListInterop\EmailAddress;
use ListInterop\Exception\Exception;
use ListInterop\ListId;
use ListInterop\SubscriberInformation;
use ListInterop\SubscriptionResult;

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
