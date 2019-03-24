<?php
return [
    'language' => 'ru',
    'sourceLanguage' => 'en',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'basePath' => '@common/lang',
                    'fileMap' => [
                        'backend/app' => 'backend/app.php',
                        'backend/errors' => 'backend/errors.php',
                        'backend/app/label' => 'backend/labels.php',
                        'backend/modules/news/main' => 'backend/modules/news/main.php',
                        'backend/modules/page/main' => 'backend/modules/page/main.php',
                        'backend/modules/widget/main' => 'backend/modules/widget/main.php',
                        'backend/modules/menu/main' => 'backend/modules/menu/main.php',
                        'backend/modules/menu/root-items' => 'backend/modules/menu/root-items.php',
                    ],
                ],
            ],
        ],
    ],
];
