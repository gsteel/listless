<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\Exception\InvalidArgument;
use GSteel\Listless\Value\ParameterMapper;
use GSteel\Listless\Value\SubscriberInformation;
use PHPUnit\Framework\TestCase;

class ParameterMapperTest extends TestCase
{
    public function testThatParametersWillBeRenamed(): void
    {
        $input = SubscriberInformation::fromArray([
            'a' => 'b',
            'c' => 'd',
        ]);

        $mapper = new ParameterMapper([
            'a' => 'z',
            'c' => 'y',
        ]);

        $result = $mapper->convert($input);

        self::assertEquals('b', $result->get('z'));
        self::assertEquals('d', $result->get('y'));
    }

    /**
     * @test
     * @psalm-suppress InvalidScalarArgument
     */
    public function mappingKeysMustBeStrings(): void
    {
        $this->expectException(InvalidArgument::class);
        new ParameterMapper([0 => 'foo']);
    }

    /**
     * @test
     * @psalm-suppress InvalidScalarArgument
     */
    public function mappingValuesMustBeStrings(): void
    {
        $this->expectException(InvalidArgument::class);
        new ParameterMapper(['foo' => 0]);
    }

    public function testThatUnmappedParametersWillNotBeIncludedInTheOutput(): void
    {
        $input = SubscriberInformation::fromArray([
            'a' => 1,
            'b' => 2,
            'c' => 3,
        ]);

        $mapper = new ParameterMapper([
            'a' => 'z',
            'b' => 'y',
        ]);

        $result = $mapper->convert($input);

        foreach (['a', 'b', 'c'] as $key) {
            self::assertFalse($result->has($key));
        }

        foreach (['z', 'y'] as $key) {
            self::assertTrue($result->has($key));
        }
    }

    public function testThatMappedParametersThatDoNotExistWillNotBeIncludedInTheOutput(): void
    {
        $input = SubscriberInformation::fromArray(['a' => 1, 'c' => 2]);
        $mapper = new ParameterMapper([
            'a' => 'z',
            'b' => 'y',
            'c' => 'x',
        ]);

        $result = $mapper->convert($input);
        self::assertTrue($result->has('z'));
        self::assertFalse($result->has('y'));
        self::assertTrue($result->has('x'));
    }
}
