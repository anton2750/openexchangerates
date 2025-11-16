<?php

namespace app\dto;

readonly class RatesDto
{
    public function __construct(
        public array $list
    )
    {}
}

