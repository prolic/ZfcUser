<?php

namespace ZfcUser\Persistence;

use ZfcBase\Persistence\DefaultFinderInterface;
use ZfcBase\Persistence\ObjectManagerInterface;
use ZfcUser\Entity\UserInterface;

interface UserManagerInterface extends
    DefaultFinderInterface,
    ObjectManagerInterface
{

    /**
     * find a user by email address
     *
     * @param string $emailAddress
     * @return UserInterface|null
     */
    public function findOneByEmailAddress($emailAddress);

    /**
     * find a user by username
     *
     * @param string $username
     * @return UserInterface|null
     */
    public function findOneByUsername($username);
}
