<?php

namespace ZfcUser\Options;

use Zend\Stdlib\Options;

class ModuleOptions extends Options implements
    AuthenticationOptionsInterface,
    RegistrationOptionsInterface,
    UserControllerOptionsInterface,
    UserServiceOptionsInterface
{
    protected $useRedirectParameterIfPresent;

    protected $loginAfterRegistration;

    protected $authIdentityFields;

    protected $userEntityClass;

    protected $enableRegistration;

    protected $enableUsername;

    protected $enableDisplayName;

    protected $requireActivation;

    protected $useRegistrationFormCaptcha;

    protected $passwordSalt;

    protected $passwordCost;

    /**
     * @param string $key name of option with underscore
     * @return string name of setter method
     */
    protected function assembleSetterNameFromKey($key)
    {
        $parts = explode('_', $key);
        $parts = array_map('ucfirst', $parts);
        $setter = 'set' . implode('', $parts);
        return $setter;
    }

    /**
     * @see ParameterObject::__set()
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $setter = $this->assembleSetterNameFromKey($key);
        if (method_exists($this, $setter)) {
            $this->{$setter}($value);
        }
    }


    public function setUseRedirectParameterIfPresent($useRedirectParameterIfPresent)
    {
        $this->useRedirectParameterIfPresent = $useRedirectParameterIfPresent;
    }

    public function getUseRedirectParameterIfPresent()
    {
        return $this->useRedirectParameterIfPresent;
    }

    public function setEnableRegistration($enableRegistration)
    {
        $this->enableRegistration = $enableRegistration;
    }

    public function getEnableRegistration()
    {
        return $this->enableRegistration;
    }

    public function setLoginAfterRegistration($loginAfterRegistration)
    {
        $this->loginAfterRegistration = $loginAfterRegistration;
    }

    public function getLoginAfterRegistration()
    {
        return $this->loginAfterRegistration;
    }

    public function setAuthIdentityFields($authIdentityFields)
    {
        $this->authIdentityFields = $authIdentityFields;
    }

    public function getAuthIdentityFields()
    {
        return $this->authIdentityFields;
    }

    /**
     * set enable username
     *
     * @param bool $flag
     * @return ModuleOptions
     */
    public function setEnableUsername($flag)
    {
        $this->enableUsername = (bool) $flag;
        return $this;
    }

    /**
     * get enable username
     *
     * @return bool
     */
    public function getEnableUsername()
    {
        return $this->enableUsername;
    }

    /**
     * set enable display name
     * @param bool $flag
     * @return ModuleOptions
     */
    public function setEnableDisplayName($flag)
    {
        $this->enableDisplayName = (bool) $flag;
        return $this;
    }

    /**
     * get enable display name
     *
     * @return bool
     */
    public function getEnableDisplayName()
    {
        return $this->enableDisplayName;
    }

    public function setUseRegistrationFormCaptcha($useRegistrationFormCaptcha)
    {
        $this->useRegistrationFormCaptcha = $useRegistrationFormCaptcha;
    }

    public function getUseRegistrationFormCaptcha()
    {
        return $this->useRegistrationFormCaptcha;
    }

    /**
     * set require activation
     *
     * @param bool $flag
     * @return ModuleOptions
     */
    public function setRequireActivation($flag)
    {
        $this->requireActivation = (bool) $flag;
        return $this;
    }

    /**
     * get require activation
     *
     * @return bool
     */
    public function getRequireActivation()
    {
        return $this->requireActivation;
    }

    public function setUserEntityClass($userEntityClass)
    {
        $this->userEntityClass = $userEntityClass;
    }

    public function getUserEntityClass()
    {
        return $this->userEntityClass;
    }

    public function setPasswordCost($passwordCost)
    {
        $this->passwordCost = $passwordCost;
    }

    public function getPasswordCost()
    {
        return $this->passwordCost;
    }

    public function setPasswordSalt($passwordSalt)
    {
        $this->passwordSalt = $passwordSalt;
    }

    public function getPasswordSalt()
    {
        return $this->passwordSalt;
    }

}