<?php

declare(strict_types=1);

namespace GSteel\Listless\Value;

use GSteel\Listless\Assert;
use GSteel\Listless\SubscriberInformation as SubscriberMeta;

use function is_iterable;

/**
 * @psalm-immutable
 */
final class SubscriberInformation implements SubscriberMeta
{
    /** @var array<array-key, scalar|scalar[]> */
    private $data;

    /** @param array<array-key, scalar|scalar[]> $data */
    private function __construct(array $data)
    {
        $this->data = $data;
    }

    /** @param array<array-key, scalar|scalar[]> $data */
    public static function fromArray(array $data): self
    {
        self::validateArray($data);

        return new self($data);
    }

    /** @return array<array-key, scalar|scalar[]> */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @param mixed|array<array-key, mixed> $value
     */
    private static function validateArray($value): void
    {
        if (is_iterable($value)) {
            /** @var mixed $subValue */
            foreach ($value as $subValue) {
                self::validateArray($subValue);
            }

            return;
        }

        Assert::scalar($value);
    }
}
