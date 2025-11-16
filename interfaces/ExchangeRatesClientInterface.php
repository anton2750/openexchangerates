<?php

namespace app\interfaces;

use app\dto\CurrenciesDto;
use app\dto\RatesDto;

interface ExchangeRatesClientInterface
{
    public function getCurrencies(): CurrenciesDto;
    public function getExchangeRates(): RatesDto;
}

