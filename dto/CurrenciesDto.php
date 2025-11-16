<?php

namespace app\dto;

readonly class CurrenciesDto
{
    public function __construct(
        public array $list,
    )
    {}

    public function getCurrencyName(string $code): ?string
    {
        return $this->list[$code] ?? null;
    }
}

