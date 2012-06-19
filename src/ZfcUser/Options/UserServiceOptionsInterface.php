<?php

namespace ZfcUser\Options;

use ZfcUser\Options\RegistrationOptionsInterface;

interface UserServiceOptionsInterface extends
    PasswordOptionsInterface,
    RegistrationOptionsInterface
{

    public function setUserEntityClass($userEntityClass);

    public function getUserEntityClass();

}