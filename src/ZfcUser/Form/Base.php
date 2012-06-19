<?php

namespace ZfcUser\Form;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use ZfcBase\Form\ProvidesEventsForm;

class Base extends ProvidesEventsForm
{
    public function __construct($name = null)
    {
        parent::__construct($name = null);

        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'label' => 'Username',
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'emailAddress',
            'attributes' => array(
                'label' => 'Email',
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'displayName',
            'attributes' => array(
                'label' => 'Display Name',
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'label' => 'Password',
                'type' => 'password'
            ),
        ));

        $this->add(array(
            'name' => 'passwordVerify',
            'attributes' => array(
                'label' => 'Password Verify',
                'type' => 'password'
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Submit',
                'type' => 'submit'
            ),
        ));

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));

        $this->add(new Csrf('csrf'));

        $this->events()->trigger('init', $this);
    }
}
