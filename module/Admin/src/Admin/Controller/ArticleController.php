<?php

namespace Admin\Controller;

use Application\Controller\AdminBaseController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class ArticleController extends AdminBaseController
{


    public function indexAction()
    {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder();

        $query->select('a')
            ->from('Blog\Entity\Article', 'a')
            ->orderBy('a.id','DESC');


        $adapter = new DoctrineAdapter(new ORMPaginator($query));
        $paginator = new Paginator($adapter);
        $paginator->setItemCountPerPage(2);
        $paginator->setCurrentPageNumber( $this->params()->fromQuery('page',1));


        return new ViewModel(['articles' => $paginator]);
    }

}