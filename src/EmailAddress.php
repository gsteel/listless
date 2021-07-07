<?php

declare(strict_types=1);

namespace GSteel\Listless;

use Stringable;

interface EmailAddress extends Stringable
{
    /**
     * The string representation of an email address without a display name or angle brackets
     *
     * Example: you@example.com
     *
     * @psalm-mutation-free
     */
    public function toString(): string;

    /**
     * The display name is optional because it might not be known
     *
     * An arbitrary string representing the recipients name, for example "Captain Kirk"
     *
     * @psalm-mutation-free
     */
    public function displayName(): ?string;

    /**
     * Check equality
     *
     * The check should be case in-sensitive and only compare the email address
     */
    public function isEqualTo(self $other): bool;
}
