<?php

return [



    'controllers' => [
        'invokables' => [
            'Admin\Controller\Index' => 'Admin\Controller\IndexController'
        ]
    ],

    'router' => [

        'routes' => [

            'admin' => [

                'type' => 'Literal',
                'options' => [
                    'route' => '/admin/',

                    'defaults' => [
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index'
                    ]

                ]
            ]
        ],
    ],

    'view_manager' => [

        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]

];