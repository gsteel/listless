<?php

declare(strict_types=1);

namespace GSteel\Listless\Action;

use GSteel\Listless\EmailAddress;
use GSteel\Listless\ListId;

interface IsSubscribed
{
    public function isSubscribed(EmailAddress $address, ListId $listId): bool;
}
