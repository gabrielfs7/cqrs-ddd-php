<?php
$fromStream = 'cqrs-v1';
$mappingPath = __DIR__ . '/eventstore/projection/';

return [
    'eventstore-projections' => [
        'user-birthdays' => [
            'mode' => 'continuous',
            'file' => [
                'path' => $mappingPath,
                'parameters' => [
                    ':fromStream' => $fromStream,
                ],
            ],
        ],
        'user-orders' => [
            'mode' => 'continuous',
            'file' => [
                'path' => $mappingPath,
                'parameters' => [
                    ':fromStream' => $fromStream,
                ],
            ],
        ],
    ],
];
