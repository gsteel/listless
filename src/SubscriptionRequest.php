<?php

declare(strict_types=1);

namespace GSteel\Listless;

interface SubscriptionRequest
{
    public function emailAddress(): EmailAddress;

    public function listId(): ListId;
}
