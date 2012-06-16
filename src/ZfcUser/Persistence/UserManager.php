<?php

namespace ZfcUser\Persistence;

use DateTime;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use ZfcBase\Persistence\AbstractDefaultTableGatewayManager;
use ZfcUser\Entity\UserInterface;

class UserManager extends AbstractDefaultTableGatewayManager implements
    UserManagerInterface,
    ServiceLocatorAwareInterface
{

    /**
     * @var UserManagerOptions
     */
    protected $options;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * creates a user from row
     * @param $row
     * @return false|object
     */
    protected function fromRow($row)
    {
        if (!$row) return false;
        $userEntityClassName = $this->getOptions()->getClassName();
        $user = $this->getHydrator()->hydrate($row->getArrayCopy(), new $userEntityClassName);
        $user->setLastLogin(DateTime::createFromFormat('Y-m-d H:i:s', $row['last_login']));
        $user->setRegisterTime(DateTime::createFromFormat('Y-m-d H:i:s', $row['register_time']));
        return $user;
    }

    /**
     * Finds all objects in the repository.
     *
     * @return mixed The objects.
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return mixed The objects.
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        // TODO: Implement findBy() method.
    }

    /**
     * Finds a single object by a set of criteria.
     *
     * @param array $criteria
     * @return object The object.
     */
    public function findOneBy(array $criteria)
    {
        // TODO: Implement findOneBy() method.
    }

    public function remove($object)
    {
        // TODO: Implement remove() method.
    }

    /**
     * find a user by email address
     *
     * @param string $emailAddress
     * @return UserInterface|null
     */
    public function findOneByEmailAddress($emailAddress)
    {
        $results = $this->events()->trigger(__FUNCTION__ . '.pre', compact('emailAddress'));
        if ($results->stopped()) {
            return $results->last();
        }
        $rowset = $this->getTableGateway()->select(array($this->getOptions()->getUserEmailAddressField() => $emailAddress));
        $row = $rowset->current();
        $user = $this->fromRow($row);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('user' => $user));
        return $user;
    }

    /**
     * find a user by username
     *
     * @param string $username
     * @return UserInterface|null
     */
    public function findOneByUsername($username)
    {
        $results = $this->events()->trigger(__FUNCTION__ . '.pre', compact('username'));
        if ($results->stopped()) {
            return $results->last();
        }
        $rowset = $this->getTableGateway()->select(array($this->getOptions()->getUserUsernameField() => $username));
        $row = $rowset->current();
        $user = $this->fromRow($row);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('user' => $user));
        return $user;
    }

    /**
     * set service options
     *
     * @param UserManagerOptions $options
     */
    public function setOptions(UserManagerOptions $options)
    {
        $this->options = $options;
    }

    /**
     * get service options
     *
     * @return UserManagerOptions
     */
    public function getOptions()
    {
        if (!$this->options instanceof UserManagerOptions) {
            $this->setOptions($this->getServiceLocator()->get('zfcuser_user_manager_options'));
        }
        return $this->options;
    }

    public function flush()
    {

    }

    /**
     * set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return UserManager
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @return AbstractTableGateway
     */
    public function getTableGateway()
    {
        if (!$this->tableGateway instanceof AbstractTableGateway) {
            $this->setTableGateway($this->getServiceLocator()->get('zfcuser_user_tablegateway'));
        }
        return $this->tableGateway;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if (!$this->hydrator instanceof HydratorInterface) {
            $this->setHydrator($this->getServiceLocator()->get('zfcuser_user_hydrator'));
        }
        return $this->hydrator;
    }

}