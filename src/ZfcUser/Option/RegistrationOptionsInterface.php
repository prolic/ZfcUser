<?php

namespace ZfcUser\Option;

interface RegistrationOptionsInterface
{

    public function setEnableDisplayName($enableDisplayName);

    public function getEnableDisplayName();

    public function setEnableUsername($enableUsername);

    public function getEnableUsername();

    public function setUseRegistrationFormCaptcha($useRegistationFormCaptcha);

    public function getUseRegistrationFormCaptcha();
}