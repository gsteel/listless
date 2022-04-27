<?php

declare(strict_types=1);

namespace ListInterop;

use ListInterop\Exception\AssertionFailed;
use Webmozart\Assert\Assert as WebmozartAssert;

final class Assert extends WebmozartAssert
{
    /**
     * @param string $message
     *
     * @inheritDoc
     * @psalm-pure
     */
    protected static function reportInvalidArgument($message): void
    {
        throw new AssertionFailed($message);
    }
}
