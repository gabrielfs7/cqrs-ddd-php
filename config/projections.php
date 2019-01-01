<?php
$mappingPath = __DIR__ . '/eventstore/projection/%s';

return [
    'eventstore-projections' => [
        'user_birthdays_projection' => [
            'mode' => 'continuous',
            'file' => [
                'path' => sprintf($mappingPath, 'user_birthdays.js'),
                'parameters' => [
                    ':resultStreamName' => 'user_birthdays_projection_result',
                    ':fromStream' => 'cqrs_ddd_php',
                ],
            ],
        ],
    ],
];
