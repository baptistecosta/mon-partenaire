<?php
return [
    'db' => [
        'adapters' => [
            'db.adapter.my-tennis-pal' => [
                'driver' => 'Pdo',
                'dsn' => 'mysql:dbname=my_tennis_pal;host=127.0.0.1',
                'username' => 'root',
                'password' => '',
                'driver_options' => [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
                ],
            ],
            'db.adapter.localities' => [
                'driver' => 'Pdo',
                'dsn' => 'mysql:dbname=localities;host=127.0.0.1',
                'username' => 'root',
                'password' => '',
                'driver_options' => [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
                ],
            ],
        ]
    ],
    'service_manager' => [
//        'factories' => [
//            'Zend\\Db\\Adapter\\Adapter' => 'Zend\\Db\\Adapter\\AdapterServiceFactory',
//        ],
        'abstract_factories' => [
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        ]
    ],
    'zf-mvc-auth' => [
        'authentication' => [
            'http' => [
                'accept_schemes' => [
                    0 => 'basic',
                ],
                'realm' => 'api',
            ],
        ],
    ],
];
