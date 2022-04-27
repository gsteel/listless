<?php

declare(strict_types=1);

namespace ListInterop;

/**
 * @psalm-immutable
 */
interface SubscriberInformation
{
    /**
     * @return mixed|null
     *
     * @psalm-mutation-free
     */
    public function get(string $key);

    /**
     * @param mixed|null $value
     *
     * @psalm-mutation-free
     */
    public function set(string $key, $value): self;

    /**
     * @psalm-mutation-free
     */
    public function has(string $key): bool;

    /**
     * @return array<string, mixed|null>
     *
     * @psalm-mutation-free
     */
    public function getArrayCopy(): array;
}
