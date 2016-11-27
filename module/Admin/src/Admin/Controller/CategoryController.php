<?php

namespace Admin\Controller;



use Admin\Form\CategoryAddForm;
use Application\Controller\AdminBaseController;
use Blog\Entity\Category;
use Zend\View\Model\ViewModel;

class CategoryController extends AdminBaseController
{
    public function indexAction()
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery('SELECT u FROM Blog\Entity\Category u ORDER BY u.id DESC');
        $rows = $query->getResult();

        return new ViewModel(['category' => $rows]);
    }


    public function addAction()
    {
        $form = new CategoryAddForm();
        $status = $message = '';
        $em = $this->getEntityManager();

        $request = $this->getRequest();
        if($request->isPost()){

            $form->setData($request->getPost());
            if($form->isValid()){

                $category = new Category();
                $category->exchangeArray($form->getData());

                $em->persist($category);
                $em->flush();


                $status = 'success';
                $message = 'Caterory was added';

            }else{

                $status = 'error';
                $message = 'Parametrs error';
            }

        }else {

            return new ViewModel(compact('form'));

        }

        if($message){

            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
        }


        return $this->redirect()->toRoute('admin/category');
    }


    public function editAction()
    {
        $message = $status = '';
        $em = $this->getEntityManager();
        $form = new CategoryAddForm();

        $id = $this->params()->fromRoute('id',0);

        $category = $em->find('Blog\Entity\Category', $id);
        if(empty($category)){
            $message = 'Category not found';
            $status = 'error';

            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);

            return $this->redirect()->toRoute('admin/category');
        }

        $form->bind($category);

        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());

            if($form->isValid()){
                $em->persist($category);
                $em->flush();

                $status = 'success';
                $message = 'Category was added';

            }else {
                $status = 'error';
                $message = 'Parameters error';

                $invalidInputs = $form->getInputFilter()->getInvalidInput();
                foreach ($invalidInputs as $errors){
                    foreach ($errors as $error){
                        $message .= " ".$error;
                    }
                }
            }

        }else{

            return new ViewModel(compact('form', 'id'));
        }

        if(!empty($message)){
            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
        }

        return $this->redirect()->toRoute('admin/category');

    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();

        $status = 'success';
        $message = 'Category was deleted';

        try{
            $repository = $em->getRepository('Blog\Entity\Category');
            $category = $repository->find($id);
            $em->remove($category);
            $em->flush();

        }catch (\Exception $e){
            $status = 'error';
            $message = 'Delete error: '. $e->getMessage();
        }

        $this->flashMessenger()
            ->setNamespace($status)
            ->addMessage($message);

        $this->redirect()->toRoute('admin/category');
    }


}