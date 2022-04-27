<?php

declare(strict_types=1);

namespace ListInterop\Action;

use ListInterop\EmailAddress;
use ListInterop\ListId;

interface Unsubscribe
{
    public function unsubscribe(EmailAddress $address, ListId $fromList): void;
}
