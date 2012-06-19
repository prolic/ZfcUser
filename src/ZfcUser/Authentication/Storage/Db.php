<?php

namespace ZfcUser\Authentication\Storage;

use Zend\Authentication\Storage;
use Zend\Authentication\Storage\StorageInterface;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcUser\Persistence\UserManagerInterface;

class Db implements Storage\StorageInterface, ServiceManagerAwareInterface
{
    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var UserManagerInterface
     */
    protected $userManager;

    /**
     * @var mixed
     */
    protected $resolvedIdentity;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Returns true if and only if storage is empty
     *
     * @throws \Zend\Authentication\Exception\InvalidArgumentException If it is impossible to determine whether storage is empty
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->getStorage()->isEmpty();
    }

    /**
     * Returns the contents of storage
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws \Zend\Authentication\Exception\InvalidArgumentException If reading contents from storage is impossible
     * @return mixed
     */
    public function read()
    {
        if (null !== $this->resolvedIdentity) {
            return $this->resolvedIdentity;
        }

        $identity = $this->getStorage()->read();

        if (is_int($identity) || is_scalar($identity)) {
            $identity = $this->getUserManager()->find($identity);
        }

        if ($identity) {
            $this->resolvedIdentity = $identity;
        } else {
            $this->resolvedIdentity = null;
        }
        
        return $this->resolvedIdentity;
    }

    /**
     * Writes $contents to storage
     *
     * @param  mixed $contents
     * @throws \Zend\Authentication\Exception\InvalidArgumentException If writing $contents to storage is impossible
     * @return void
     */
    public function write($contents)
    {
        $this->resolvedIdentity = null;
        $this->getStorage()->write($contents);
    }

    /**
     * Clears contents from storage
     *
     * @throws \Zend\Authentication\Exception\InvalidArgumentException If clearing contents from storage is impossible
     * @return void
     */
    public function clear()
    {
        $this->resolvedIdentity = null;
        $this->getStorage()->clear();
    }

    /**
     * getStorage 
     * 
     * @return Storage\StorageInterface
     */
    public function getStorage()
    {
        if (null === $this->storage) {
            $this->setStorage(new Storage\Session);
        }
        return $this->storage;
    }

    /**
     * setStorage
     * 
     * @param Storage\StorageInterface $storage 
     * @access public
     * @return Db
     */
    public function setStorage(Storage\StorageInterface $storage)
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * getMapper 
     * 
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        if (null === $this->userManager) {
            $this->userManager = $this->getServiceManager()->get('zfcuser_user_manager');
        }
        return $this->userManager;
    }

    /**
     * setMapper 
     * 
     * @param UserManagerInterface $mapper
     * @return Db
     */
    public function setUserManager(UserManagerInterface $mapper)
    {
        $this->userManager = $mapper;
        return $this;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $locator
     * @return void
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }
}
