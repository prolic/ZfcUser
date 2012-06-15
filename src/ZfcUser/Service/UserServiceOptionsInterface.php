<?php

namespace ZfcUser\Service;

use ZfcUser\Option\RegistrationOptionsInterface;

interface UserServiceOptionsInterface extends RegistrationOptionsInterface
{
    public function setRequireActivation($requireActivation);

    public function getRequireActivation();

    public function setUserEntityClass($userEntityClass);

    public function getUserEntityClass();

    public function setUserMetaEntityClass($userMetaEntityClass);

    public function getUserMetaEntityClass();
}