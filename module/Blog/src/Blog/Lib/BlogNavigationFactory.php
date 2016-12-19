<?php

namespace Blog\Lib;

use Zend\Navigation\Service\DefaultNavigationFactory;

class BlogNavigationFactory extends DefaultNavigationFactory
{

    protected function getName()
    {
        return 'blog_navigation';
    }

}


