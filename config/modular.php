<?php

return [

    'path' => base_path() . '/App/Modules',
    'base_namespace' => 'App/Modules', 
    'groupWithoutPrefix' => 'Pub',
    'groupMiddleware' => [
        'Admin' => [
            'web' => ['auth'],
            'api' => ['auth:api']
        ]
    ],

    'modules' => [
        'Admin' => [
            'Dashboard',
            'User',
        ],
        'Pub' => [
            'Auth',
        ],
    ]


        ];