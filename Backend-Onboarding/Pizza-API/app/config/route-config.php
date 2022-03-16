<?php
    define('ROUTES', [
        'POST' => [
            'register' => ['Users', 'register', false],
            'login' => ['Users', 'login', false],
            'logout' => ['Users', 'logout', false],
            'order' => ['Orders', 'order', false]
        ], 
        'GET' => [
            'products' => ['Products', 'products', true],
            'categories' => ['Categories', 'categories', true],
            'orders' => ['Orders', 'orders', true],
            'profile' => ['Users', 'current', true]
        ],
        'PUT' => [
            'profile' => ['Users', 'update', true]
        ],
    ]);