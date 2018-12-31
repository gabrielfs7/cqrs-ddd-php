<?php
$mappingPath = __DIR__ . '/eventstore/projection/%s';

return [
    'eventstore-projections' => [
        'user-birthdays-projection' => [
            'mode' => 'continuous',
            'file' => [
                'path' => sprintf($mappingPath, 'user-birthdays.js'),
                'parameters' => [
                    ':resultStreamName' => 'user-birthdays-projection-result',
                    ':fromStream' => 'cqrs_ddd_php',
                ],
            ],
        ],
    ],
];
