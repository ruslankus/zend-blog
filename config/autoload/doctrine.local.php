<?php

    return array(
        'doctrine' => array(
            'connection' => array(
                // default connection name
                'orm_default' => array(
                    'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                    'params' => array(
                        'host'     => '172.17.0.2',
                        'port'     => '3306',
                        'user'     => 'root',
                        'password' => 'mysql',
                        'dbname'   => 'zblog',
                    )
                )
            )
        ),
    );