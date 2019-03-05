<?php

return [
    'debug' => true,

    'base_url' => 'apts',

    'log_file_path' => 'logs.txt',
    
    'storage_path' => 'public/uploads',

    'database' => [
        'name' => 'apartments',
        'username' => 'daniele',
        'password' => 'daniele83',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],

    'silly_auth' => [
        'user' => 'daniele',
        'pass' => 'daniele83',
        'cookie_name' => 'apts_cookie',
        'session_name' => 'apts_session',
    ],
];
