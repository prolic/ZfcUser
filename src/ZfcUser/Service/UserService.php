<?php

namespace ZfcUser\Service;

use DateTime;
use Zend\Authentication\AuthenticationService;
use Zend\Crypt\Password\Bcrypt;
use Zend\Form\Form;
use Zend\Form\FormInterface;
use ZfcBase\Service\AbstractService;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Options\UserServiceOptionsInterface;
use ZfcUser\Persistence\UserManagerInterface;

class UserService extends AbstractService implements UserServiceInterface
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
     * @var UserManagerInterface
     */
    protected $userManager;

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

        $bcrypt = new Bcrypt();
        $bcrypt->setSalt($this->getOptions()->getPasswordSalt());
        $bcrypt->setCost($this->getOptions()->getPasswordCost());
        $user->setPassword($bcrypt->create($user->getPassword()));
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
            $this->getUserManager()->persist($user);
            $this->getUserManager()->flush();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die;
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
        $className = $this->getOptions()->getUserEntityClass();
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
            $this->setOptions($this->getServiceLocator()->get('zfcuser_module_options'));
        }
        return $this->options;
    }

    /**
     * get user manager
     *
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        if (!$this->userManager instanceof UserManagerInterface) {
            $this->setUserManager($this->getServiceLocator()->get('zfcuser_user_manager'));
        }
        return $this->userManager;
    }

    /**
     * set user manager
     *
     * @param UserManagerInterface $userManager
     * @return UserService
     */
    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
        return $this;
    }


}
