<?php

declare(strict_types=1);

namespace ListInterop\Value;

use ListInterop\Assert;
use ListInterop\ListId as ListIdContract;

/**
 * @psalm-immutable
 */
final class ListId implements ListIdContract
{
    private string $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromString(string $id): self
    {
        Assert::notEmpty($id, 'The mailing list identifier cannot be empty');

        return new self($id);
    }

    /**
     * @psalm-mutation-free
     */
    public function toString(): string
    {
        return $this->id;
    }

    public function isEqualTo(ListIdContract $other): bool
    {
        return $this->toString() === $other->toString();
    }
}
