<?php

namespace ZfcUser\Options;

interface AuthenticationOptions
{
    public function setAuthIdentityFields($authIdentityFields);

    public function getAuthIdentityFields();
}