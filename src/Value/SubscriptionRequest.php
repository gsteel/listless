<?php

declare(strict_types=1);

namespace GSteel\Listless\Value;

use GSteel\Listless\EmailAddress;
use GSteel\Listless\ListId;
use GSteel\Listless\SubscriptionRequest as RequestContract;

/**
 * @psalm-immutable
 */
final class SubscriptionRequest implements RequestContract
{
    /** @var ListId */
    private $listId;
    /** @var EmailAddress */
    private $email;

    private function __construct(
        EmailAddress $address,
        ListId $listId
    ) {
        $this->email = $address;
        $this->listId = $listId;
    }

    public static function new(
        EmailAddress $address,
        ListId $listId
    ): self {
        return new self($address, $listId);
    }

    public function emailAddress(): EmailAddress
    {
        return $this->email;
    }

    public function listId(): ListId
    {
        return $this->listId;
    }
}
