<?php

namespace Blog\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;


use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class IndexController extends BaseController
{
    public function indexAction()
    {

        $em = $this->getEntityManager();
        $query =  $em->createQueryBuilder();

        $currentPage = $this->params()->fromQuery('page',1);

        $query->add('select', 'a')
            ->add('from','Blog\Entity\Article a')
            ->add('where', 'a.isPublic=1')
            ->add('orderBy', 'a.id ASC');

        $adapter = new DoctrineAdapter(new ORMPaginator($query));

        $paginator = new Paginator($adapter);
        $paginator->setItemCountPerPage(1);
        $paginator->setCurrentPageNumber($currentPage);


        return new ViewModel(['articles' => $paginator]);
    }
}