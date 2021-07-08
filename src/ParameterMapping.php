<?php

declare(strict_types=1);

namespace GSteel\Listless;

interface ParameterMapping
{
    public function convert(SubscriberInformation $input): SubscriberInformation;
}
