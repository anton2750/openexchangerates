<?php

namespace app\components\openexchangerates_api;

use app\dto\CurrenciesDto;
use app\dto\RatesDto;
use app\interfaces\ExchangeRatesClientInterface;
use yii\base\Component;

class MockClient extends Component implements ExchangeRatesClientInterface
{
    public function getExchangeRates(): RatesDto
    {
        return new RatesDto([
            'RUB' => 80.01,
            'EUR' => 0.8601,
        ]);
    }

    public function getCurrencies(): CurrenciesDto
    {
        return new CurrenciesDto([
            'AED' => 'United Arab Emirates Dirham',
            'RUB' => 'Russian Ruble',
            'EUR' => 'Euro',
        ]);
    }
}