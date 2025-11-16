<?php

namespace app\components\openexchangerates_api;

use app\dto\RatesDto;
use app\interfaces\ExchangeRatesClientInterface;
use yii\base\Component;

class MockClient extends Component implements ExchangeRatesClientInterface
{
    public function getExchangeRates(): RatesDto
    {
        return new RatesDto(80.00001,0.8600001);
    }
}