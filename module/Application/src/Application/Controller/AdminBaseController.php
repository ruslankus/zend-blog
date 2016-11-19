<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 12/11/16
 * Time: 16:37
 */

namespace Application\Controller;


use Zend\Mvc\MvcEvent;

class AdminBaseController extends BaseController
{

    public function onDispatch(MvcEvent $e)
    {

        return parent::onDispatch($e);
    }
}