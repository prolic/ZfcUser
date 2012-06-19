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
        $data['email_address'] = $object->getEmailAddress();
        $data['display_name'] = $object->getDisplayName();
        $data['password'] = $object->getPassword();
        $lastLogin = $object->getLastLogin();
        if ($lastLogin instanceof DateTime) {
            $data['last_login'] = $lastLogin->format('Y-m-d H:i:s');
        }
        $data['last_ip'] = $object->getLastIp();
        $registerTime = $object->getRegisterTime();
        if ($registerTime instanceof DateTime) {
            $data['register_time'] = $registerTime->format('Y-m-d H:i:s');
        }
        $data['register_ip'] = $object->getRegisterIp();
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
        if (isset($data['email_address'])) {
            $object->setEmailAddress($data['email_address']);
        }
        if (isset($data['display_name'])) {
            $object->setDisplayName($data['display_name']);
        }
        if (isset($data['password'])) {
            $object->setPassword($data['password']);
        }
        if (isset($data['last_login'])) {
            $object->setLastLogin(new DateTime($data['last_login']));
        }
        if (isset($data['last_ip'])) {
            $object->setLastIp($data['last_ip']);
        }
        if (isset($data['register_time'])) {
            $object->setRegisterTime(new DateTime($data['register_time']));
        }
        if (isset($data['register_ip'])) {
            $object->setRegisterIp($data['register_ip']);
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