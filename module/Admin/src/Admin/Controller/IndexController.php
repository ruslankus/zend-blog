<?php

namespace Admin\Controller;

use Application\Controller\AdminBaseController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AdminBaseController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}