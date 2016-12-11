<?php
namespace Admin\Form;

use DoctrineModule\Form\Element\ObjectSelect;
use Zend\Form\Form;
use Zend\Form\Element;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Blog\Entity\Article;

use Admin\Filter\ArticleAddInputFilter;

class ArticleAddForm extends Form implements ObjectManagerAwareInterface
{


    protected $objectManager;


    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('articleAddForm');
        $this->setObjectManager($objectManager);

        $this->createElements();

    }

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }


    public function createElements()
    {
        $this->setAttribute('method','post');
        $this->setAttribute('class','form-horizontal');

        //set input filter
        $this->setInputFilter(new ArticleAddInputFilter());

        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'category',
            'options' => [
                'label' => 'Category',
                'empty_option' => 'Select category...',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Blog\Entity\Category',
                'property' => 'categoryName'
            ],

            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ]
        ]);


        $this->add([
            'name' => 'title',
            'type' => 'Text',
            'options' => [
                'min' => 3,
                'max' => 100,
                'label' => 'Title'
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ]
        ]);

        $this->add([
           'name' => 'shortArticle',
            'type' => 'TextArea',
            'options' => [
                'label' => 'Title snippet',
            ],
            'attributes' => [
                'class' => 'form-control ckeditor'
            ]

        ]);

        $this->add([
            'name' => 'article',
            'type' => 'TextArea',
            'options' => [
                'label' => 'Article',
            ],
            'attributes' => [
                'class' => 'form-control ckeditor',
                'required' => 'required'
            ]

        ]);

        $this->add([
            'name' => 'isPublic',
            'type' => 'Checkbox',
            'options' => [
                'label' => 'Published',
                'use_hidden_Element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Save',
                'id' => 'btn_submit',
                'class' => 'btn btn-primary'
            ]
        ]);


    }
}

