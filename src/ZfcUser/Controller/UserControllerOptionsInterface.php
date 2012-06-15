<?php

namespace ZfcUser\Controller;

interface UserControllerOptionsInterface
{

    public function setUseRedirectParameterIfPresent($useRedirectParameterIfPresent);

    public function getUseRedirectParameterIfPresent();

    public function setEnableRegistration($enableRegistration);

    public function getEnableRegistration();

    public function setLoginAfterRegistration($loginAfterRegistration);

    public function getLoginAfterRegistration();

    public function setAuthIdentityFields($authIdentityFields);

    public function getAuthIdentityFields();
}