<?php

declare(strict_types=1);

namespace ListInterop\Action;

use ListInterop\EmailAddress;
use ListInterop\ListId;

interface IsSubscribed
{
    public function isSubscribed(EmailAddress $address, ListId $listId): bool;
}
