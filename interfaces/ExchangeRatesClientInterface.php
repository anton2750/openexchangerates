<?php

namespace app\interfaces;

use app\dto\RatesDto;

interface ExchangeRatesClientInterface
{
    public function getExchangeRates(): RatesDto;
}

