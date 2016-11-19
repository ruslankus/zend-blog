<?php

return [



    'controllers' => [
        'invokables' => [
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Category' => 'Admin\Controller\CategoryController',

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

                ],

                'may_terminate' => true,

                'child_routes' => [
                    'category' => [

                        'type' => 'segment',
                        'options' => [
                            'route' => 'category/[:action/][:id/]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => [
                                'controller' => 'Category',
                                'action' => 'index'
                            ]
                        ]
                    ]
                ], //child_routes


            ],


        ],
    ],

    'view_manager' => [

        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]

];