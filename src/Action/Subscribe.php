<?php

declare(strict_types=1);

namespace GSteel\Listless\Action;

use GSteel\Listless\EmailAddress;
use GSteel\Listless\ListId;
use GSteel\Listless\SubscriberInformation;
use GSteel\Listless\SubscriptionResult;

interface Subscribe
{
    public function subscribe(
        EmailAddress $address,
        ListId $listId,
        ?SubscriberInformation $subscriberInformation = null
    ): SubscriptionResult;
}
