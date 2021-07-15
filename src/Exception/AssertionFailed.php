<?php

declare(strict_types=1);

namespace GSteel\Listless\Exception;

use InvalidArgumentException;

final class AssertionFailed extends InvalidArgumentException implements Exception
{
}
