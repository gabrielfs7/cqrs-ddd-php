<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => false,
        'eventstore' => [
            'host' => 'http://cqrs_ddd_php_eventstore',
            'port' => '2113',
            'stream' => 'cqrs_ddd_php',
        ],
        'doctrine' => [
            'dev_mode' => true,
            'prefixes' => [
                __DIR__ . '/../orm' => 'Sample\Domain\Entity',
            ],
            'connection' => [
                'driver' => 'pdo_postgres',
                'host' => 'cqrs_ddd_php_postgres',
                'port' => 5432,
                'dbname' => 'cqrs_ddd_php_postgres',
                'user' => 'root',
                'password' => 'root',
                'charset' => 'utf8',
            ]
        ]
    ],
];
