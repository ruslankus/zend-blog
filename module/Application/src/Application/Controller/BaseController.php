<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 12/11/16
 * Time: 15:33
 */

namespace Application\Controller;


use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

class BaseController extends AbstractActionController
{

    protected $entityManger;

    public function onDispatch(MvcEvent $e)
    {
        $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        return parent::onDispatch($e);
    }


    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManger = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManger;
    }
}