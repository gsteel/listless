<?php

declare(strict_types=1);

namespace GSteel\Listless;

/**
 * @psalm-immutable
 */
interface SubscriptionResult
{
    /**
     * The subscription was immediately processed and the address was successfully subscribed
     */
    public const SUBSCRIBED = 1;

    /**
     * The subscription was submitted for processing, but the final result is not yet known
     */
    public const SUBMITTED = 2;

    /**
     * The email address submitted is already subscribed
     */
    public const DUPLICATE = 4;

    /**
     * The given email address was rejected during processing and was not subscribed
     */
    public const REJECTED = 8;

    /**
     * Something went wrong during processing and the email address was not subscribed
     */
    public const ERROR = 16;

    /**
     * The email address was successfully processed and accepted, but requires further confirmation
     */
    public const PENDING = 32;

    /**
     * Whether the outcome of the process is considered successful or not
     */
    public function isSuccess(): bool;
}
