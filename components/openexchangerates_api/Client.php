<?php

namespace app\components\openexchangerates_api;

use app\dto\RatesDto;
use app\interfaces\ExchangeRatesClientInterface;
use yii\base\Exception;

class Client extends \yii\base\Component implements ExchangeRatesClientInterface
{
    public $apiKey;
    public $baseUrl;

    /**
     * @var int Таймаут для запросов в секундах
     */
    public $timeout = 30;

    /**
     * @var int Таймаут подключения в секундах
     */
    public $connectTimeout = 10;

    public function init()
    {
        parent::init();
    }

    public function makeRequest($method, $endpoint, $postData = null, $headers = [])
    {
        $url = $this->baseUrl . $endpoint;

        // Базовые заголовки
        $defaultHeaders = [
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        $allHeaders = array_merge($defaultHeaders, $headers);

        // Инициализируем cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $allHeaders);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        // Добавляем данные для POST/PUT запросов
        if ($postData !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, is_string($postData) ? $postData : json_encode($postData));
        }

        // Выполняем запрос
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // Обрабатываем результат
        if ($error) {
            return [
                'success' => false,
                'error' => true,
                'message' => 'cURL Error: ' . $error,
                'data' => null,
                'http_code' => 0,
                'raw_response' => null
            ];
        }

        $decodedResponse = json_decode($response, true);

        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'error' => $httpCode >= 400,
            'message' => $httpCode >= 400 ? 'HTTP Error: ' . $httpCode : 'Success',
            'data' => $decodedResponse,
            'http_code' => $httpCode,
            'raw_response' => $response,
            'url' => $url,
            'method' => $method
        ];
    }

    /**
     * @throws Exception
     */
    public function getExchangeRates(): RatesDto
    {
        $endpoint = 'api/latest.json?app_id=' . $this->apiKey;
        $response = $this->makeRequest('GET', $endpoint);


        if (!$response['success']) {
            throw new Exception('API Error: ' . $response['message']);
        }

        $rates = $response['data']['rates'];

        return new RatesDto($rates['RUB'], $rates['EUR']);
    }
}