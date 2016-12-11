<?php

namespace Admin\Controller;

use Admin\Filter\ArticleAddInputFilter;
use Admin\Form\ArticleAddForm;
use Application\Controller\AdminBaseController;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

use Blog\Entity\Article;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

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


    public function addAction()
    {
        $em = $this->getEntityManager();
        $form = new ArticleAddForm($em);

        $request = $this->getRequest();
        if($request->isPost()){

            $message = $status = '';

            $data = $request->getPost();
            $article = new Article();

            $form->setHydrator(new DoctrineHydrator($em,'\Article'));
            $form->bind($article);
            $form->setData($data);

            if($form->isValid()){

                $em->persist($article);
                $em->flush();

                $status = 'success';
                $message = 'Article was added';
            }else{

                $status = 'error';
                $message = 'Paremeters error';

                $filters = $form->getInputFilter();

                foreach ($filters->getInvalidInput() as $errors){
                    foreach ($errors->getMessages() as $error){
                        $message .= " " . $error;
                    }
                }
            }

        } else {
            return compact('form');
        }


        if($message) {
            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
        }

        return $this->redirect()->toRoute('admin/article');
    }

    public function editAction()
    {
        $message = $status = '';
        $em = $this->getEntityManager();
        $form = new ArticleAddForm($em);

        $id = $this->params()->fromRoute('id',0);
        $article = $em->find('Blog\Entity\Article', $id);

        if(empty($article)){

            $message = 'Article not found';
            $status = 'error';

            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);

            $this->redirect()->toRoute('admin/article');
        }


        $form->setHydrator(new DoctrineHydrator($em, '\Article'));
        $form->bind($article);

        $request = $this->getRequest();

        if($request->isPost()){


            $data = $request->getPost();
            $form->setData($data);

            if( $form->isValid()){
                $em->persist($article);
                $em->flush();


                $status = 'success';
                $message = 'Article updated';
            }

        }else {

            return compact('form','id');
        }

        if($message){
            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
        }

        return $this->redirect()->toRoute('admin/article');
    }


    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id',0);
        $em = $this->getEntityManager();

        $status = 'success';
        $message = 'Article was deleted';

        try {

            $repository = $em->getRepository('Blog\Entity\Article');
            $article = $repository->find($id);
            $em->remove($article);
            $em->flush();

        }catch (\Exception $e){

            $status = 'error';
            $message = 'atricle delete error = '. $e->getMessage();
        }

        $this->flashMessenger()
            ->setNamespace($status)
            ->addMessage($message);

        return $this->redirect()->toRoute('admin/article');

    }

}