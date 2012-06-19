<?php

namespace ZfcUser\Options;

use ZfcUser\Options\AuthenticationOptions;

interface UserControllerOptionsInterface
{

    public function setUseRedirectParameterIfPresent($useRedirectParameterIfPresent);

    public function getUseRedirectParameterIfPresent();

}