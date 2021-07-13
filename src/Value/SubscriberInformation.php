<?php

declare(strict_types=1);

namespace GSteel\Listless\Value;

use GSteel\Listless\Assert;
use GSteel\Listless\SubscriberInformation as SubscriberMeta;

use function array_keys;
use function is_iterable;

/**
 * @psalm-immutable
 */
final class SubscriberInformation implements SubscriberMeta
{
    /** @var array<string, mixed|null> */
    private array $data;

    /** @param array<string, mixed|null> $data */
    private function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param array<string, mixed|null> $data
     *
     * @psalm-mutation-free
     */
    public static function fromArray(array $data): self
    {
        Assert::allString(array_keys($data));
        self::validateArray($data);

        return new self($data);
    }

    /** @inheritDoc */
    public function getArrayCopy(): array
    {
        return $this->data;
    }

    /**
     * @param mixed|null $value
     *
     * @psalm-mutation-free
     */
    private static function validateArray($value): void
    {
        if (is_iterable($value)) {
            /** @psalm-var mixed $subValue */
            foreach ($value as $subValue) {
                self::validateArray($subValue);
            }

            return;
        }

        Assert::nullOrScalar($value);
    }

    /** @inheritDoc */
    public function get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    /** @inheritDoc */
    public function set(string $key, $value): SubscriberMeta
    {
        $input = $this->data;
        /** @psalm-suppress MixedAssignment */
        $input[$key] = $value;

        return self::fromArray($input);
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }
}
