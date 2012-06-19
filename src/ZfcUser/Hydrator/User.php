<?php

namespace ZfcUser\Hydrator;

use DateTime;
use Zend\Stdlib\Hydrator\HydratorInterface;
use ZfcUser\Entity\UserInterface;

class User implements HydratorInterface
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function extract($object)
    {
        if (!$object instanceof UserInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of ZfcUser\Entity\UserInterface');
        }
        /* @var $object UserInterface*/
        $data = array();
        $data['id'] = $object->getId();
        $data['username'] = $object->getUsername();
        $data['emailAddress'] = $object->getEmailAddress();
        $data['displayName'] = $object->getDisplayName();
        $data['password'] = $object->getPassword();
        $lastLogin = $object->getLastLogin();
        if ($lastLogin instanceof DateTime) {
            $data['lastLogin'] = $lastLogin->format('Y-m-d H:i:s');
        }
        $data['lastIp'] = $object->getLastIp();
        $registerTime = $object->getRegisterTime();
        if ($registerTime instanceof DateTime) {
            $data['registerTime'] = $registerTime->format('Y-m-d H:i:s');
        }
        $data['registerIp'] = $object->getRegisterIp();
        $data['active'] = $object->getActive();
        $data['enabled'] = $object->getEnabled();
        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return UserInterface
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof UserInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of ZfcUser\Entity\UserInterface');
        }
        if (isset($data['id'])) {
            $object->setId($data['id']);
        }
        if (isset($data['username'])) {
            $object->setUsername($data['username']);
        }
        if (isset($data['emailAddress'])) {
            $object->setEmailAddress($data['emailAddress']);
        }
        if (isset($data['displayName'])) {
            $object->setDisplayName($data['displayName']);
        }
        if (isset($data['password'])) {
            $object->setPassword($data['password']);
        }
        if (isset($data['lastLogin'])) {
            $object->setLastLogin(new DateTime($data['lastLogin']));
        }
        if (isset($data['lastIp'])) {
            $object->setLastIp($data['lastIp']);
        }
        if (isset($data['registerTime'])) {
            $object->setRegisterTime(new DateTime($data['registerTime']));
        }
        if (isset($data['registerIp'])) {
            $object->setRegisterIp($data['registerIp']);
        }
        if (isset($data['active'])) {
            $object->setActive($data['active']);
        }
        if (isset($data['enabled'])) {
            $object->setEnabled($data['enabled']);
        }
        return $object;
    }

}