<?php

return [
    'id'        => 'yii2-user-test',
    'basePath'  => dirname(__DIR__),
    'extensions' => require(VENDOR_DIR . '/yiisoft/extensions.php'),
    'aliases' => [
        '@mata/modulemenu' => realpath(__DIR__. '/../../../../'),
        '@vendor'        => VENDOR_DIR,
        '@bower'         => VENDOR_DIR . '/bower',
    ],
    'modules' => [
        'moduleMenu' => [
            'class' => 'mata\modulemenu\Module',
        ]
    ],
    'components' => [
        'assetManager' => [
            // 'basePath' => '@tests/codeception/app/assets'
        ],
        'log'   => null,
        'cache' => null,
        'request' => [
            'enableCsrfValidation'   => false,
            'enableCookieValidation' => false
        ],

        'db' => require __DIR__ . '/db.php',
        //     'db' => [
        //                 'class' => 'yii\db\Connection',
        //                 'dsn' => 'mysql:host=localhost;dbname=mata-module-testing',
        //                 'username' => 'mata',
        //                 'password' => 'Qseft56%',
        //                 'charset' => 'utf8',
        // ],
        'mailer' => [
            // 'class' => 'yii\swiftmailer\Mailer',
            // 'useFileTransport' => true
        ],
    ],
];
