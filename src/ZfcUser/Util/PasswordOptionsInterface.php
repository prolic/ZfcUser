<?php

namespace ZfcUser\Util;

interface PasswordOptionsInterface
{

    public function setBlowfishCost($blowfishCost);

    public function getBlowfishCost();

    public function setPasswordHashAlgorithm($passwordHashAlgorithm);

    public function getPasswordHashAlgorithm();

    public function setSha256Rounds($sha256Rounds);

    public function getSha256Rounds();

    public function setSha512Rounds($sha512Rounds);

    public function getSha512Rounds();

}