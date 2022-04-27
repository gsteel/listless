<?php

declare(strict_types=1);

namespace ListInterop\Value;

use ListInterop\SubscriptionResult as Result;

/**
 * @psalm-immutable
 */
final class SubscriptionResult implements Result
{
    private const SUCCESS_CODE = self::SUBMITTED | self::SUBSCRIBED | self::PENDING;
    private const FAILURE_CODE = self::DUPLICATE | self::ERROR | self::DUPLICATE;

    private int $code;

    private function __construct(
        int $resultCode
    ) {
        $this->code = $resultCode;
    }

    public static function subscribed(): self
    {
        return new self(self::SUBSCRIBED);
    }

    public static function pending(): self
    {
        return new self(self::PENDING);
    }

    public static function duplicate(): self
    {
        return new self(self::DUPLICATE);
    }

    public static function submitted(): self
    {
        return new self(self::SUBMITTED);
    }

    public static function rejected(): self
    {
        return new self(self::REJECTED);
    }

    public static function error(): self
    {
        return new self(self::ERROR);
    }

    public function isSuccess(): bool
    {
        return ($this->code & self::SUCCESS_CODE) === $this->code;
    }

    public function equals(Result $other): bool
    {
        return $this->resultCode() === $other->resultCode();
    }

    public function resultCode(): int
    {
        return $this->code;
    }
}
