<?php

declare(strict_types=1);

namespace ListInterop;

interface ListId
{
    /**
     * The identifier for a mailing list as a string
     *
     * @psalm-mutation-free
     */
    public function toString(): string;

    /**
     * @psalm-pure
     */
    public function isEqualTo(self $other): bool;
}
