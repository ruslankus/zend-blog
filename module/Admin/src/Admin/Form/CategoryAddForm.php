<?php

namespace Admin\Form;

use Zend\Form\Form;
//use Zend\InputFilter\Factory as InputFactory;
//use Zend\InputFilter\Input;

class CategoryAddForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('categoryAddForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'bs-example form-horizontal');

        //$this->setInputFilter(new CategoryAddInputFilter());

        $this->add([

            'name' => 'categoryKey',
            'type' => 'Text',
            'options' => [
                'min' => 3,
                'max' => 100,
                'label' => 'Key'
            ],
            'attributes' => [
                'class' => 'form-control',
                 'required' => 'required',
            ]
        ]);

        $this->add([

            'name' => 'categoryName',
            'type' => 'Text',
            'options' => [
                'min' => 3,
                'max' => 100,
                'label' => 'Name'

            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ]
        ]);


        $this->add([

            'name' => 'submit',
            'type' => 'Submit',

            'attributes' => [
                'id' => 'btn_submit',
                'class' => 'btn btn-primary',
                'value' => 'Send'
            ]
        ]);



    }


}



