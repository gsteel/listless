<?php

declare(strict_types=1);

namespace GSteel\Listless\Value;

use GSteel\Listless\SubscriptionResult as Result;

/**
 * @psalm-immutable
 */
final class SubscriptionResult implements Result
{
    private const SUCCESS_CODE = self::SUBMITTED | self::SUBSCRIBED;
    private const FAILURE_CODE = self::DUPLICATE | self::ERROR | self::DUPLICATE;

    /** @var int */
    private $code;

    private function __construct(
        int $resultCode
    ) {
        $this->code = $resultCode;
    }

    public static function subscribed(): self
    {
        return new self(self::SUBSCRIBED);
    }

    public static function duplicate(): self
    {
        return new self(self::DUPLICATE);
    }

    public function isSuccess(): bool
    {
        return ($this->code & self::SUCCESS_CODE) === $this->code;
    }
}
