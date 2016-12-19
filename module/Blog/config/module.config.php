<?php

return [

    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'blog_entity' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . "/../src/Blog/Entity",
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Blog\Entity' => 'blog_entity'
                ]
            ]
        ]
    ],

    'controllers' => [
        'invokables' => [
            'Blog\Controller\Index' => 'Blog\Controller\IndexController'
        ]
    ],

    'router' => [

        'routes' => [

            'blog' => [

                'type' => 'segment',
                'options' => [
                    'route' => '/[:action/][:id/]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
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