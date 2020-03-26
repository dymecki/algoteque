<?php

declare(strict_types = 1);

include_once '../bootstrap.php';

use GuzzleHttp\Client;

$params = [
    'json' => [
        'distances'     => [
            ['length' => 3, 'unit' => 'Yards'],
            ['length' => 5, 'unit' => 'Meters'],
            ['length' => 8.7, 'unit' => 'Yards']
        ],
        //        'response_unit' => 'Meters',
        'response_unit' => 'Yards'
    ]
];

echo (new Client())->post(getenv('APP_URL') . '/api.php', $params)->getBody()->getContents();
