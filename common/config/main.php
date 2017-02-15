<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//		'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=120.76.26.165;dbname=cinema',
//            'username' => 'gtstj_dev',
//            'password' => 'gt_dev_2016_db',
//            'charset' => 'utf8',
//        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=wb_cinema',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => true,
            'rules' => [
            ],
        ],
    ],
];
