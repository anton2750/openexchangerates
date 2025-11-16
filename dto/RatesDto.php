<?php

namespace app\dto;

readonly class RatesDto
{
    public function __construct(
        public float $rub,
        public float $eur,
    )
    {}
}

