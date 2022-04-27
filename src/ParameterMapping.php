<?php

declare(strict_types=1);

namespace ListInterop;

interface ParameterMapping
{
    public function convert(SubscriberInformation $input): SubscriberInformation;
}
