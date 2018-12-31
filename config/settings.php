<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => false,
        'responseChunkSize' => 4096,
        'outputBuffering' => 'append',
        'httpVersion' => '2.0',
        'eventstore' => [
            'url' => 'http://cqrs_ddd_php_eventstore:2113',
            'stream' => 'cqrs_ddd_php',
            'username' => 'admin',
            'password' => 'changeit',
        ],
        'rabbitmq' => [
            'host' => 'cqrs_ddd_php_rabbitmq',
            'port' => 5672,
            'user' => 'root',
            'password' => 'root',
        ],
        'doctrine' => [
            'dev_mode' => true,
            'prefixes' => [
                __DIR__ . '/orm' => 'Sample\Domain\Entity',
            ],
            'connection' => [
                'driver' => 'pdo_pgsql',
                'host' => 'cqrs_ddd_php_postgres',
                'port' => 5432,
                'dbname' => 'cqrs_ddd_php',
                'user' => 'root',
                'password' => 'root',
                'charset' => 'utf8',
            ],
        ],
    ],
];
