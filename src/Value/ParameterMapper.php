<?php

declare(strict_types=1);

namespace ListInterop\Value;

use ListInterop\Assert;
use ListInterop\ParameterMapping;
use ListInterop\SubscriberInformation;
use ListInterop\Value\SubscriberInformation as Parameters;

use function array_flip;

final class ParameterMapper implements ParameterMapping
{
    /** @var array<string, string> */
    private array $map;

    /**
     * @param array<string, string> $map
     */
    public function __construct(array $map)
    {
        Assert::allString($map);
        Assert::allString(array_flip($map));

        $this->map = $map;
    }

    public function convert(SubscriberInformation $input): SubscriberInformation
    {
        $output = [];
        foreach ($this->map as $oldKey => $newKey) {
            if (! $input->has($oldKey)) {
                continue;
            }

            /** @var scalar|array<array-key, scalar> $value */
            $value = $input->get($oldKey);
            $output[$newKey] = $value;
        }

        return Parameters::fromArray($output);
    }
}
