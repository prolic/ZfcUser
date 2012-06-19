<?php

namespace ZfcUser\Form;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use ZfcBase\Form\ProvidesEventsForm;
use ZfcUser\Options\AuthenticationOptions;
use ZfcUser\Module as ZfcUser;

class Login extends ProvidesEventsForm
{
    /**
     * @var AuthenticationOptions
     */
    protected $options;

    public function __construct($name = null, AuthenticationOptions $options)
    {
        $this->setOptions($options);
        parent::__construct($name);

        $this->add(array(
            'name' => 'identity',
            'attributes' => array(
                'label' => '',
                'type' => 'text'
            ),
        ));

        $emailElement = $this->get('identity');
        $label = $emailElement->getAttribute('label');
        // @TODO: make translation-friendly
        foreach ($this->getOptions()->getAuthIdentityFields() as $mode) {
            $label = (!empty($label) ? $label . ' or ' : '') . ucfirst($mode);
        }
        $emailElement->setAttribute('label', $label);
        
        $this->add(array(
            'name' => 'credential',
            'attributes' => array(
                'label' => 'Password',
                'type' => 'password',
            ),
        ));

        $this->add(new Csrf('csrf'));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'label' => 'Submit',
                'type' => 'submit'
            ),
        ));

        $this->events()->trigger('init', $this);
    }

    /**
     * set options
     *
     * @param AuthenticationOptions $options
     * @return Login
     */
    public function setOptions(AuthenticationOptions $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * get options
     *
     * @return AuthenticationOptions
     */
    public function getOptions()
    {
        return $this->options;
    }
}
