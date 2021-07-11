<?php

declare(strict_types=1);

namespace GSteel\Listless\Action;

use GSteel\Listless\EmailAddress;
use GSteel\Listless\ListId;

interface Unsubscribe
{
    public function unsubscribe(EmailAddress $address, ListId $fromList): void;
}
