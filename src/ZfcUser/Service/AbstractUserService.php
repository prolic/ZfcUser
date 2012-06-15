<?php

namespace ZfcUser\Service;

use DateTime;
use Zend\Authentication\AuthenticationService;
use Zend\Form\Form;
use Zend\Form\FormInterface;
use ZfcBase\Service\AbstractService;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Entity\UserMetaInterface;
use ZfcUser\Util\Password;

abstract class AbstractUserService extends AbstractService implements UserServiceInterface
{

    /**
     * @var mixed
     */
    protected $resolvedIdentity;

    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @var FormInterface
     */
    protected $loginForm;

    /**
     * @var FormInterface
     */
    protected $registerForm;

    /**
     * @var UserServiceOptionsInterface
     */
    protected $options;

    /**
     * register
     *
     * @param array $data
     * @return UserInterface
     * @throws Exception\InvalidArgumentException
     */
    public function register(array $data)
    {
        $user = $this->newUser();

        $form = $this->getRegisterForm();
        $form->bind($user);
        $form->setData($data);
        if (!$form->isValid()) {
            throw new Exception\InvalidArgumentException('invalid data');
        }

        $user = $form->getData();
        /* @var $user UserInterface */

        $user->setPassword(Password::hash($user->getPassword()));
        $user->setRegisterTime(new DateTime('now'));
        $user->setRegisterIp($_SERVER['REMOTE_ADDR']);
        $user->setEnabled(true);

        /**
         * @todo put in hydatrator ???
         */
        if ($this->getOptions()->getRequireActivation()) {
            $user->setActive(false);
        } else {
            $user->setActive(true);
        }
        if ($this->getOptions()->getEnableUsername()) {
            $user->setUsername($data['username']);
        }
        if ($this->getOptions()->getEnableDisplayName()) {
            $user->setDisplayName($data['display_name']);
        }

        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user, 'form' => $form));
        try {
            $this->persistUser($user, true); // force immediate write
        } catch (\Exception $e) {
            throw new Exception\RegistrationException('error on persistence');
        }
        return $user;
    }

    /**
     * get authentication service
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        if (null === $this->authService) {
            $this->authService = $this->getServiceLocator()->get('zfcuser_auth_service');
        }
        return $this->authService;
    }

    /**
     * set authentication service
     *
     * @param AuthenticationService $authService
     * @return AbstractUserService
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
        return $this;
    }

    /**
     * @return FormInterface
     */
    public function getRegisterForm()
    {
        if (null === $this->registerForm) {
            $this->registerForm = $this->getServiceLocator()->get('zfcuser_register_form');
        }
        return $this->registerForm;
    }

    /**
     * @param FormInterface $registerForm
     * @return User
     */
    public function setRegisterForm(FormInterface $registerForm)
    {
        $this->registerForm = $registerForm;
        return $this;
    }

    /**
     * returns a new user
     *
     * @return UserInterface
     */
    protected function newUser()
    {
        $className = $this->getUserClassName();
        return new $className;
    }

    /**
     * returns new user meta
     *
     * @return UserMetaInterface
     */
    protected function newUserMeta()
    {
        $className = $this->getUserMetaClassName();
        return new $className;
    }

    /**
     * set service options
     *
     * @param UserServiceOptionsInterface $options
     */
    public function setOptions(UserServiceOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * get service options
     *
     * @return UserServiceOptionsInterface
     */
    public function getOptions()
    {
        if (!$this->options instanceof UserServiceOptionsInterface) {
            $this->setOptions($this->getServiceLocator()->get('zfcuser_user_service_options'));
        }
        return $this->options;
    }


}
