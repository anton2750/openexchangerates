<?php

use app\interfaces\ExchangeRatesClientInterface;
use yii\di\Instance;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qgf93TIPmNrX9Dijr0BvcUcigTjemCPc',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'openechangerates' => [
            'class' => \app\components\openexchangerates_api\Client::class,
            'baseUrl' => 'https://openexchangerates.org/',
            'apiKey' => getenv('API_KEY'),
        ],
    ],
    'params' => $params,
    'container' => [
        'definitions' => [
            \app\interfaces\ExchangeRatesClientInterface::class => function () {
                return Yii::$app->get('openechangerates');
            }
//            \app\interfaces\ExchangeRatesClientInterface::class => Instance::of(\app\components\openexchangerates_api\MockClient::class),
        ],
    ],
];

return $config;
