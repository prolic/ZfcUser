<?php

namespace ZfcUser\Form;

use Zend\Form\Element\Captcha as Captcha;
use Zend\Form\Form;
use ZfcUser\Module;
use ZfcUser\Options\RegistrationOptionsInterface;

class Register extends Base
{
    protected $captcha_element= null;

    /**
     * @var RegistrationOptionsInterface
     */
    protected $options;

    /**
     * @param string|null $name
     * @param RegistrationOptionsInterface $options
     */
    public function __construct($name = null, RegistrationOptionsInterface $options)
    {
        $this->setOptions($options);
        parent::__construct($name);
        
        $this->remove('id');
        if (!$this->getOptions()->getEnableUsername()) {
            $this->remove('username');
        }
        if (!$this->getOptions()->getEnableDisplayName()) {
            $this->remove('displayName');
        }
        if ($this->getOptions()->getUseRegistrationFormCaptcha() && $this->captcha_element) {
            $this->add($this->captcha_element, array('name'=>'captcha'));
        }
        $this->get('submit')->setAttribute('Label', 'Register');
    }

    public function setCaptchaElement(Captcha $captcha_element)
    {
        $this->captcha_element= $captcha_element;
    }
    
    /**
     * set options
     *
     * @param RegistrationOptionsInterface $options
     * @return Register
     */
    public function setOptions(RegistrationOptionsInterface $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * get options
     *
     * @return RegistrationOptionsInterface
     */
    public function getOptions()
    {
        return $this->options;
    }


}
