<?php

namespace ZfcUser\Service;

use DateTime;
use Zend\Authentication\AuthenticationService;
use Zend\Form\Form;
use Zend\Form\FormInterface;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Entity\UserMetaInterface;
use ZfcUser\Util\Password;

class User extends AbstractUserService
{
    /**
     * find one by username
     *
     * @param string $username
     * @return UserInterface|null
     */
    public function findOneByUsername($username)
    {
        // TODO: Implement findOneByUsername() method.
    }

    /**
     * find one by email address
     *
     * @param string $emailAddress
     * @return UserInterface|null
     */
    public function findOneByEmail($emailAddress)
    {
        // TODO: Implement findOneByEmail() method.
    }

    /**
     * persist user
     *
     * @param UserInterface $user
     * @param bool $flush
     */
    public function persistUser(UserInterface $user, $flush = false)
    {
        // TODO: Implement persistUser() method.
    }

    /**
     * persist user meta
     *
     * @param UserMetaInterface $userMeta
     * @param bool $flush
     */
    public function persistUserMeta(UserMetaInterface $userMeta, $flush = false)
    {
        // TODO: Implement persistUserMeta() method.
    }

    /**
     * remove user
     *
     * @param UserInterface $user
     * @param bool $flush
     */
    public function removeUser(UserInterface $user, $flush = false)
    {
        // TODO: Implement removeUser() method.
    }

}
