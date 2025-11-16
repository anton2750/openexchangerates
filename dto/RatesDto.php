<?php

namespace app\dto;

readonly class RatesDto
{
    public function __construct(
        public array $list
    )
    {}

    public function getRate(string $code): ?string
    {
        return $this->list[$code] ?? null;
    }
}

