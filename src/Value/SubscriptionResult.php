<?php

declare(strict_types=1);

namespace GSteel\Listless\Value;

use GSteel\Listless\SubscriptionRequest;
use GSteel\Listless\SubscriptionResult as Result;

final class SubscriptionResult implements Result
{
    private const SUCCESS_CODE = self::SUBMITTED | self::SUBSCRIBED;
    private const FAILURE_CODE = self::DUPLICATE | self::ERROR | self::DUPLICATE;

    /** @var int */
    private $code;
    /** @var SubscriptionRequest */
    private $request;

    private function __construct(
        int $resultCode,
        SubscriptionRequest $request
    ) {
        $this->code = $resultCode;
        $this->request = $request;
    }

    public static function subscribed(SubscriptionRequest $request): self
    {
        return new self(self::SUBSCRIBED, $request);
    }

    public static function duplicate(SubscriptionRequest $request): self
    {
        return new self(self::DUPLICATE, $request);
    }

    public function request(): SubscriptionRequest
    {
        return $this->request;
    }

    public function isSuccess(): bool
    {
        return ($this->code & self::SUCCESS_CODE) === $this->code;
    }
}
