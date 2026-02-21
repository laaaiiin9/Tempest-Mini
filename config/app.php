<?php

return [
    'env' => 'local',
    'app_name' => 'Tempest',
    'rate_limits' => [
        'register' => [
            'max_attempts' => 5,
            'decay_seconds' => 60,
        ],
    ],
];
