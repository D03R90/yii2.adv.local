<?php
return [
    'bootstrap' => ['bootstrap'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'bootstrap' => [
            'class' => \common\components\BootstrapComponent::class
        ],
        'bot' => [
            'class' => \SonkoDmitry\Yii\TelegramBot\Component::class,
            'apiToken' => '888388881:AAECdKfPj1d6Eu2-D0btTfEPMp0v4zu_6IU',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
