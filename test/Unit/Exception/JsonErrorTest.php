<?php

declare(strict_types=1);

namespace ListInterop\Test\Unit\Exception;

use ListInterop\Exception\BadMethodCall;
use ListInterop\Exception\JsonError;
use ListInterop\Json;
use PHPUnit\Framework\TestCase;

class JsonErrorTest extends TestCase
{
    public function testThatTheStringPayloadIsAvailableWhenDecodingFails(): void
    {
        $input = '{"foo":"bar",}';
        try {
            Json::decodeToArray($input);
            $this->fail('No exception was thrown');
        } catch (JsonError $error) {
            self::assertEquals($input, $error->jsonString());
        }
    }

    public function testThatAttemptingToRetrieveThePayloadIsExceptionalWhenItIsNull(): void
    {
        $error = new JsonError('Foo');
        $this->expectException(BadMethodCall::class);
        $error->jsonString();
    }
}
