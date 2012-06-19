<?php

namespace ZfcUser\Persistence;

use DateTime;
use ZfcBase\Mapper\AbstractDbMapper;
use ZfcUser\Entity\UserInterface;

class UserManager extends AbstractDbMapper implements
    UserManagerInterface
{

    /**
     * find a user by email address
     *
     * @param string $emailAddress
     * @return UserInterface|null
     */
    public function findOneByEmailAddress($emailAddress)
    {
        $criteria = array('emailAddress' => $emailAddress);
        return $this->findOneBy($criteria);
    }

    /**
     * find a user by username
     *
     * @param string $username
     * @return UserInterface|null
     */
    public function findOneByUsername($username)
    {
        $criteria = array('username' => $username);
        return $this->findOneBy($criteria);
    }

}