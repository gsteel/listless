<?php

declare(strict_types=1);

namespace GSteel\Listless\Test\Unit\Value;

use GSteel\Listless\Exception\AssertionFailed;
use GSteel\Listless\Value\SubscriberInformation;
use PHPUnit\Framework\TestCase;
use stdClass;

use function array_keys;

class SubscriberInformationTest extends TestCase
{
    /**
     * @test
     * @psalm-suppress InvalidScalarArgument
     */
    public function nonScalarValuesInTheConstructorShouldBeExceptional(): void
    {
        $this->expectException(AssertionFailed::class);
        SubscriberInformation::fromArray([new stdClass()]);
    }

    /** @test */
    public function dataShouldBeStoredUnmodified(): void
    {
        $input = [
            'mushrooms' => 'goats',
            'fruits' => [
                'apples',
                'pears',
            ],
        ];

        $info = SubscriberInformation::fromArray($input);

        self::assertEquals($input, $info->getArrayCopy());
    }

    /** @test */
    public function itShouldBePossibleForSubscriberInformationToBeEmpty(): void
    {
        self::assertEquals([], SubscriberInformation::fromArray([])->getArrayCopy());
    }

    /** @test */
    public function notExistentKeysShouldBeNull(): void
    {
        $params = SubscriberInformation::fromArray([]);
        self::assertNull($params->get('key'));
    }

    /** @test */
    public function valuesGivenToTheConstructorCanBeRetrievedByName(): void
    {
        self::assertEquals('bar', SubscriberInformation::fromArray(['foo' => 'bar'])->get('foo'));
    }

    public function testThatAValueCanBeSet(): void
    {
        $params = SubscriberInformation::fromArray([]);
        $clone = $params->set('key', 'value');
        self::assertNotSame($params, $clone);
        self::assertEquals('value', $clone->get('key'));
    }

    /**
     * @test
     * @psalm-suppress UnusedMethodCall
     */
    public function nonScalarValuesInSetShouldBeExceptional(): void
    {
        $this->expectException(AssertionFailed::class);
        SubscriberInformation::fromArray([])->set('foo', new stdClass());
    }

    /** @test */
    public function hasWillReturnTrueForAnyValidValueThatHasBeenSet(): void
    {
        $input = [
            'a' => 'a',
            'b' => '',
            'c' => 0.0,
            'd' => 0,
            'e' => false,
            'f' => true,
            'g' => 1,
            'h' => 2.3,
            'i' => [],
            'j' => ['foo'],
            'k' => ['a' => 'b'],
        ];
        $params = SubscriberInformation::fromArray($input);

        foreach (array_keys($input) as $key) {
            self::assertTrue($params->has($key));
        }
    }

    public function testHasWillReturnFalseForAnUnknownKey(): void
    {
        self::assertFalse(
            SubscriberInformation::fromArray([])->has('foo')
        );
    }

    /**
     * @test
     * @psalm-suppress InvalidScalarArgument
     */
    public function itShouldBeExceptionalToProvideAnArrayWithoutStringsForTopLevelItems(): void
    {
        $this->expectException(AssertionFailed::class);
        SubscriberInformation::fromArray(['foo', 'bar']);
    }

    /** @test */
    public function nestedArraysWithIntegerKeysShouldBeAcceptable(): void
    {
        $input = ['foo' => ['foo', 'bar']];
        $info = SubscriberInformation::fromArray($input);
        self::assertEquals($input, $info->getArrayCopy());
    }

    /** @test */
    public function itShouldBePossibleToProvideNullValuesWithInputArrays(): void
    {
        $input = ['foo' => ['foo' => null, 'bar' => null], 'baz' => null];
        $info = SubscriberInformation::fromArray($input);
        self::assertEquals($input, $info->getArrayCopy());
    }
}
