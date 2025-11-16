<?php

namespace app\controllers;

use app\interfaces\ExchangeRatesClientInterface;
use yii\web\Controller;

class SiteController extends Controller
{

    public function __construct($id, $module,
        public ExchangeRatesClientInterface $client,
        $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $currencies = $this->client->getCurrencies();
        $rates = $this->client->getExchangeRates();

        return $this->render('index', compact('currencies', 'rates'));
    }
}
