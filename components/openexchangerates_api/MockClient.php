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
        return new RatesDto(80.00001, 0.8600001);
    }

    public function getCurrencies(): CurrenciesDto
    {
        $list = [
            'AED' => 'United Arab Emirates Dirham',
            'AFN' => 'Afghan Afghani',
            'ALL' => 'Albanian Lek',
            'AMD' => 'Armenian Dram',
            'ANG' => 'Netherlands Antillean Guilder',
            'RUB' => 'Russian Ruble',
            'UAH' => 'Ukrainian Hryvnia',
            'USD' => 'United States Dollar',
            'XDR' => 'Special Drawing Rights',
            'XOF' => 'CFA Franc BCEAO',
            'XPD' => 'Palladium Ounce',
            'XPF' => 'CFP Franc',
            'XPT' => 'Platinum Ounce',
            'YER' => 'Yemeni Rial',
            'ZAR' => 'South African Rand',
            'ZMW' => 'Zambian Kwacha',
            'ZWG' => 'Zimbabwean ZiG',
            'ZWL' => 'Zimbabwean Dollar'
        ];

        return new CurrenciesDto($list);
    }
}