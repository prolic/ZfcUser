<?php

namespace ZfcUser\Validator;

use Zend\Validator\AbstractValidator,
    ZfcUser\Persistence\UserManagerInterface as UserManager;

abstract class AbstractRecord extends AbstractValidator
{
    /**
     * Error constants
     */
    const ERROR_NO_RECORD_FOUND = 'noRecordFound';
    const ERROR_RECORD_FOUND    = 'recordFound';

    /**
     * @var array Message templates
     */
    protected $_messageTemplates = array (
        self::ERROR_NO_RECORD_FOUND => "No record matching '%value%' was found",
        self::ERROR_RECORD_FOUND    => "A record matching '%value%' was found",
    );

    /**
     * @var UserManager
     */
    protected $userManager;

    /**
     * @var string
     */
    protected $key;

    /**
     * Required options are:
     *  - key     Field to use, 'emial' or 'username'
     */
    public function __construct(array $options)
    {
        if (!array_key_exists('key', $options)) {
            throw new Exception\InvalidArgumentException('No key provided');
        }
        
        $this->setKey($options['key']);
        
        parent::__construct($options);
    }

    /**
     * get user manager
     * 
     * @return UserManager
     */
    public function getUserManager()
    {
        return $this->userManager;
    }

    /**
     * get user manager
     * 
     * @param UserManager $repository
     * @return AbstractRecord
     */
    public function setUserManager(UserManager $manager)
    {
        $this->userManager = $manager;
        return $this;
    }

    /**
     * Get key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
 
    /**
     * Set key.
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Grab the user from the mapper
     * 
     * @param string $value
     * @return mixed
     */
    protected function query($value)
    {
        $result = false;

        switch ($this->getKey()) {
            case 'email':
                $result = $this->getUserManager()->findOneByEmailAddress($value);
                break; 

            case 'username':
                $result = $this->getUserManager()->findOneByUsername($value);
                break;

            default:
                throw new \Exception('Invalid key used in ZfcUser validator');
                break;
        }

        return $result;
    }
}
