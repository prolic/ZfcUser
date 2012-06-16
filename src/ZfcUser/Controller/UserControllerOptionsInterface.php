<?php

namespace ZfcUser\Controller;

use ZfcUser\Authentication\AuthenticationOptions;

interface UserControllerOptionsInterface extends AuthenticationOptions
{

    public function setUseRedirectParameterIfPresent($useRedirectParameterIfPresent);

    public function getUseRedirectParameterIfPresent();

    public function setEnableRegistration($enableRegistration);

    public function getEnableRegistration();

    public function setLoginAfterRegistration($loginAfterRegistration);

    public function getLoginAfterRegistration();

}