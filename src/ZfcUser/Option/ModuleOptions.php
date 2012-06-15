<?php

namespace ZfcUser\Option;

use Zend\Stdlib\Options;
use ZfcUser\Controller\UserControllerOptionsInterface;
use ZfcUser\Service\UserServiceOptionsInterface;
use ZfcUser\Util\PasswordOptionsInterface;

class ModuleOptions extends Options implements
    PasswordOptionsInterface,
    UserControllerOptionsInterface,
    UserServiceOptionsInterface
{
    protected $useRedirectParameterIfPresent;

    protected $loginAfterRegistration;

    protected $authIdentityFields;

    protected $userEntityClass;

    protected $userMetaEntityClass;

    protected $enableRegistration;

    protected $enableUsername;

    protected $enableDisplayName;

    protected $requireActivation;

    protected $useRegistrationFormCaptcha;

    protected $passwordHashAlgorithm;

    protected $blowfishCost;

    protected $sha256Rounds;

    protected $sha512Rounds;

    public function setBlowfishCost($blowfishCost)
    {
        $this->blowfishCost = $blowfishCost;
    }

    public function getBlowfishCost()
    {
        return $this->blowfishCost;
    }

    public function setPasswordHashAlgorithm($passwordHashAlgorithm)
    {
        $this->passwordHashAlgorithm = $passwordHashAlgorithm;
    }

    public function getPasswordHashAlgorithm()
    {
        return $this->passwordHashAlgorithm;
    }

    public function setSha256Rounds($sha256Rounds)
    {
        $this->sha256Rounds = $sha256Rounds;
    }

    public function getSha256Rounds()
    {
        return $this->sha256Rounds;
    }

    public function setSha512Rounds($sha512Rounds)
    {
        $this->sha512Rounds = $sha512Rounds;
    }

    public function getSha512Rounds()
    {
        return $this->sha512Rounds;
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

    public function setUserMetaEntityClass($userMetaEntityClass)
    {
        $this->userMetaEntityClass = $userMetaEntityClass;
    }

    public function getUserMetaEntityClass()
    {
        return $this->userMetaEntityClass;
    }


}