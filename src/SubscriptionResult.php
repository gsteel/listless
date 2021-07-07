<?php

declare(strict_types=1);

namespace GSteel\Listless;

interface SubscriptionResult
{
    public const SUBSCRIBED = 0b00001;
    public const SUBMITTED  = 0b00010;
    public const DUPLICATE  = 0b00100;
    public const REJECTED   = 0b01000;
    public const ERROR      = 0b10000;

    /**
     * The submitted request
     */
    public function request(): SubscriptionRequest;
}
