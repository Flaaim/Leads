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
            'LeadComment',
            'LeadComments',
            'Source',
            'Lead',
            'Dashboard',
            'User',
        ],
        'Pub' => [
            'Auth',
        ],
    ]


        ];