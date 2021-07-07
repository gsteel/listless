<?php

declare(strict_types=1);

namespace GSteel\Listless;

use GSteel\Listless\Exception\InvalidArgument;
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
        throw new InvalidArgument($message);
    }
}
