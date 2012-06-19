<?php

namespace ZfcUser\Service;

use Zend\Authentication\AuthenticationService;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\Form\FormInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Options\UserServiceOptionsInterface;
use ZfcUser\Persistence\UserManagerInterface;


interface UserServiceInterface extends
    ServiceLocatorAwareInterface,
    EventManagerAwareInterface
{
    /**
     * register a new user
     *
     * @param array $data
     * @return UserInterface
     * @throws Exception\InvalidArgumentException
     */
    public function register(array $data);

    /**
     * get authentication service
     *
     * @return AuthenticationService
     */
    public function getAuthService();

    /**
     * set authentication service
     *
     * @param AuthenticationService $authService
     * @return UserServiceInterface
     */
    public function setAuthService(AuthenticationService $authService);

    /**
     * get register form
     *
     * @return FormInterface
     */
    public function getRegisterForm();

    /**
     * set register form
     *
     * @param FormInterface $registerForm
     * @return UserServiceInterface
     */
    public function setRegisterForm(FormInterface $registerForm);

    /**
     * set service options
     *
     * @param UserServiceOptionsInterface $options
     */
    public function setOptions(UserServiceOptionsInterface $options);

    /**
     * get service options
     *
     * @return UserServiceOptionsInterface
     */
    public function getOptions();

    /**
     * get user manager
     *
     * @return UserManagerInterface
     */
    public function getUserManager();

    /**
     * set user manager
     *
     * @param UserManagerInterface $userManager
     * @return UserServiceInterface
     */
    public function setUserManager(UserManagerInterface $userManager);

}