<?php

declare(strict_types=1);

namespace GSteel\Listless\Action;

use GSteel\Listless\SubscriptionRequest;
use GSteel\Listless\SubscriptionResult;

interface Subscribe
{
    public function subscribe(SubscriptionRequest $request): SubscriptionResult;
}
