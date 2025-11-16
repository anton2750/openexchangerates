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

    public function hasCurrency(string $code): bool
    {
        return isset($this->list[$code]);
    }
}

