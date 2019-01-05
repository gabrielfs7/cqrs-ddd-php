<?php
$fromCategory = 'cqrs';
$mappingPath = __DIR__ . '/eventstore/projection/';

return [
    'eventstore-projections' => [
        'user-birthdays' => [
            'mode' => 'continuous',
            'file' => [
                'path' => $mappingPath,
                'parameters' => [
                    ':fromCategory' => $fromCategory,
                ],
            ],
        ],
        'user-orders' => [
            'mode' => 'continuous',
            'file' => [
                'path' => $mappingPath,
                'parameters' => [
                    ':fromCategory' => $fromCategory,
                ],
            ],
        ],
    ],
];
