<?php

namespace ZfcUser\Persistence;

use ZfcBase\Persistence\DefaultObjectManagerOptions;

class UserManagerOptions extends DefaultObjectManagerOptions
{

    protected $userEmailAddressField;

    protected $userUsernameField;


    public function setUserEmailAddressField($userEmailAddressField)
    {
        $this->userEmailAddressField = $userEmailAddressField;
    }

    public function getUserEmailAddressField()
    {
        return $this->userEmailAddressField;
    }

    public function setUserUsernameField($userUsernameField)
    {
        $this->userUsernameField = $userUsernameField;
    }

    public function getUserUsernameField()
    {
        return $this->userUsernameField;
    }
}