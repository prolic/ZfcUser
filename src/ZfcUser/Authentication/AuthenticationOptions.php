<?php

namespace ZfcUser\Authentication;

interface AuthenticationOptions
{
    public function setAuthIdentityFields($authIdentityFields);

    public function getAuthIdentityFields();
}