<?php

return [



    'controllers' => [
        'invokables' => [
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Category' => 'Admin\Controller\CategoryController',
            'Article' => 'Admin\Controller\ArticleController',

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
                    ],
                    'article' => [

                        'type' => 'segment',
                        'options' => [
                            'route' => 'article/[:action/][:id/]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => [
                                'controller' => 'Article',
                                'action' => 'index'
                            ]
                        ]
                    ]

                ], //child_routes


            ],


        ],
    ],

    'service_manager' => [

        'factories' => [

            'navigation'          => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'admin_navigation'    => 'Admin\Lib\AdminNavigationFactory'
        ]
    ],

    'navigation' => [

        'default' => [

            [
                'label' => 'Main',
                'route' => 'home'
            ]
        ],

        'admin_navigation' => [

            [
                'label'    => 'Control panel',
                'route'    => 'admin',
                'action'   => 'index',
                'resource' => 'Admin\Controller\Index',

                'pages'    => [

                    [
                        'label'   => 'Articles',
                        'route'   => 'admin/article',
                        'action'  => 'index'
                    ],

                    [
                        'label'   => 'Add article',
                        'route'   => 'admin/article',
                        'action'  => 'add'
                    ],

                    [
                        'label'   => 'Category',
                        'route'   => 'admin/category',
                        'action'  => 'index'
                    ],

                    [
                        'label'   => 'Add category',
                        'route'   => 'admin/category',
                        'action'  => 'add'
                    ],

                    /*
                    [
                        'label'   => 'Comments',
                        'route'   => 'admin/comment',
                        'action'  => 'index'
                    ]
                    */


                ]
            ]
        ]

    ],

    'view_manager' => [

        'template_path_stack' => [
            __DIR__ . '/../view',
        ],

        'template_map' => [
            'pagination_control' => __DIR__ . '/../view/layout/pagination_control.phtml'
        ]
    ],

    'module_layouts' => [
        'Admin' => 'layout/admin-layout'
    ]



];