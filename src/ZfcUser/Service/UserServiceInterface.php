<?php

namespace ZfcUser\Service;

use Zend\Authentication\AuthenticationService;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\Form\FormInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Entity\UserMetaInterface;


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
     * find one by username
     *
     * @param string $username
     * @return UserInterface|null
     */
    public function findOneByUsername($username);

    /**
     * find one by email address
     *
     * @param string $emailAddress
     * @return UserInterface|null
     */
    public function findOneByEmail($emailAddress);

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
     * persist user
     *
     * @param UserInterface $user
     * @param bool $flush
     */
    public function persistUser(UserInterface $user, $flush = false);

    /**
     * persist user meta
     *
     * @param UserMetaInterface $userMeta
     * @param bool $flush
     */
    public function persistUserMeta(UserMetaInterface $userMeta, $flush = false);

    /**
     * remove user
     *
     * @param UserInterface $user
     * @param bool $flush
     */
    public function removeUser(UserInterface $user, $flush = false);

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
}