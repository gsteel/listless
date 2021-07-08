<?php

declare(strict_types=1);

namespace GSteel\Listless;

/**
 * @psalm-immutable
 */
interface SubscriberInformation
{
    /**
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param scalar|array<array-key, scalar> $value
     *
     * @psalm-mutation-free
     */
    public function set(string $key, $value): self;
}
