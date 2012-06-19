<?php

namespace ZfcUser\Authentication\Adapter;

use DateTime;
use Zend\Authentication\Result as AuthenticationResult;
use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcUser\Authentication\Adapter\AdapterChainEvent as AuthEvent;
use ZfcUser\Options\AuthenticationOptionsInterface;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Persistence\UserManagerInterface as UserManager;

class Db extends AbstractAdapter implements ServiceManagerAwareInterface
{
    /**
     * @var UserManager
     */
    protected $userManager;

    /**
     * @var closure / invokable object
     */
    protected $credentialPreprocessor;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var AuthenticationOptionsInterface
     */
    protected $options;

    public function authenticate(AuthEvent $e)
    {
        if ($this->isSatisfied()) {
            $storage = $this->getStorage()->read();
            $e->setIdentity($storage['identity'])
              ->setCode(AuthenticationResult::SUCCESS)
              ->setMessages(array('Authentication successful.'));
            return;
        }

        $identity   = $e->getRequest()->post()->get('identity');
        $credential = $e->getRequest()->post()->get('credential');
        $credential = $this->preProcessCredential($credential);
        $userObject = NULL;

        // Cycle through the configured identity sources and test each
        $fields = $this->getOptions()->getAuthIdentityFields();

        while ( !is_object($userObject) && count($fields) > 0 ) {
            $mode = array_shift($fields);
            switch ($mode) {
                case 'username':
                    $userObject = $this->getUserManager()->findOneByUsername($identity);
                    break;
                case 'emailAddress':
                    $userObject = $this->getUserManager()->findOneByEmailAddress($identity);
                    break;
            }
        }

        if (!$userObject) {
            $e->setCode(AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND)
              ->setMessages(array('A record with the supplied identity could not be found.'));
            $this->setSatisfied(false);
            return false;
        }

        $bcrypt = new Bcrypt();
        $bcrypt->setSalt($this->getOptions()->getPasswordSalt());
        $bcrypt->setCost($this->getOptions()->getPasswordCost());

        if (!$bcrypt->verify($credential, $userObject->getPassword())) {
            // Password does not match
            $e->setCode(AuthenticationResult::FAILURE_CREDENTIAL_INVALID)
                ->setMessages(array('Supplied credential is invalid.'));
            $this->setSatisfied(false);
            return false;
        }

        // Success!
        $e->setIdentity($userObject->getId());
        $this->updateUserLastLogin($userObject)
             ->updateUserPasswordHash($userObject, $credential)
             ->setSatisfied(true);
        $storage = $this->getStorage()->read();
        $storage['identity'] = $e->getIdentity();
        $this->getStorage()->write($storage);
        $e->setCode(AuthenticationResult::SUCCESS)
          ->setMessages(array('Authentication successful.'));
    }

    protected function updateUserPasswordHash(UserInterface $userObject, $password)
    {
        $bcrypt = new Bcrypt();
        $bcrypt->setSalt($this->getOptions()->getPasswordSalt());
        $bcrypt->setCost($this->getOptions()->getPasswordCost());

        $newHash = $bcrypt->create($password);
        if ($newHash === $userObject->getPassword()) return $this;

        $userObject->setPassword($newHash);

        $this->getUserManager()->persist($userObject);
        return $this;
    }

    protected function updateUserLastLogin(UserInterface $userObject)
    {
        $userObject->setLastLogin(new DateTime('now'))
                   ->setLastIp($_SERVER['REMOTE_ADDR']);

        $this->getUserManager()->persist($userObject);
        return $this;
    }

    public function preprocessCredential($credential)
    {
        $processor = $this->getCredentialPreprocessor();
        if (is_callable($processor)) {
            return $processor($credential);
        }
        return $credential;
    }

    /**
     * get user manager
     * 
     * @return UserManager
     */
    public function getUserManager()
    {
        if (!$this->userManager instanceof UserManager) {
            $this->setUserManager($this->getServiceManager()->get('zfcuser_user_manager'));
        }
        return $this->userManager;
    }

    /**
     * setMapper
     * 
     * @param UserManager $userManager
     * @return Db
     */
    public function setUserManager(UserManager $userManager)
    {
        $this->userManager = $userManager;
        return $this;
    }

    /**
     * Get credentialPreprocessor.
     *
     * @return \callable
     */
    public function getCredentialPreprocessor()
    {
        return $this->credentialPreprocessor;
    }
 
    /**
     * Set credentialPreprocessor.
     *
     * @param $credentialPreprocessor the value to be set
     */
    public function setCredentialPreprocessor($credentialPreprocessor)
    {
        $this->credentialPreprocessor = $credentialPreprocessor;
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

    /**
     * @param AuthenticationOptionsInterface $options
     */
    public function setOptions(AuthenticationOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * @return AuthenticationOptionsInterface
     */
    public function getOptions()
    {
        if (!$this->options instanceof AuthenticationOptionsInterface) {
            $this->setOptions($this->getServiceManager()->get('zfcuser_module_options'));
        }
        return $this->options;
    }
}
