<?php

return [
    'debug' => true,

    // database configuration
    'database' => [
        'name' => 'apartments',
        'username' => 'daniele',
        'password' => 'daniele83',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],

    // auth configuration
    'silly_auth' => [
        'user' => 'admin',
        'pass' => 'pass',
        'cookie_name' => 'apts_cookie',
        'session_name' => 'apts_session',
    ],

    // 'base_url' => 'apts',

    // uncomment this if you want to use log using the function addLog()
    // 'log_file_path' => 'logs.txt',

    // path of the folder where you are going to store the uploaded files
    // 'storage_path' => 'public/uploads',
];
