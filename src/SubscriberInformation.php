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
     * @param scalar|array<array-key, scalar|null> $value
     *
     * @psalm-mutation-free
     */
    public function set(string $key, $value): self;

    public function has(string $key): bool;

    /**
     * @return array<string, scalar|scalar[]|null[]|null>
     */
    public function getArrayCopy(): array;
}
