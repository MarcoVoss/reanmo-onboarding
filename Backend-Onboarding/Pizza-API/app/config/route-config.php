<?php
    define('ROUTES', [
        'POST' => [
            'register' => ['Users', 'register', false],
            'login' => ['Users', 'login', false]
        ], 
        'GET' => [
            'products' => ['', '', true],
            'categories' => ['', '', true],
            'orders' => ['', '', true],
            'profile' => ['Users', 'current', true]
        ],
        'PUT' => [
            'profile' => ['', '', true]
        ],
    ]);