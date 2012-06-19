<?php

namespace ZfcUser\Entity;

use DateTime;

interface UserInterface
{
    /**
     * Get userId.
     *
     * @return int userId
     */
    public function getId();
 
    /**
     * Set userId.
     *
     * @param int $userId the value to be set
     * @return UserInterface
     */
    public function setId($userId);
 
    /**
     * Get username.
     *
     * @return string username
     */
    public function getUsername();
 
    /**
     * Set username.
     *
     * @param string $username the value to be set
     * @return UserInterface
     */
    public function setUsername($username);
 
    /**
     * Get email address
     *
     * @return string email
     */
    public function getEmailAddress();
 
    /**
     * Set email address
     *
     * @param string $emailAddress the value to be set
     * @return UserInterface
     */
    public function setEmailAddress($emailAddress);
 
    /**
     * Get displayName.
     *
     * @return string displayName
     */
    public function getDisplayName();
 
    /**
     * Set displayName.
     *
     * @param string $displayName the value to be set
     * @return UserInterface
     */
    public function setDisplayName($displayName);
 
    /**
     * Get password.
     *
     * @return string password
     */
    public function getPassword();
 
    /**
     * Set password.
     *
     * @param string $password the value to be set
     * @return UserInterface
     */
    public function setPassword($password);
 
    /**
     * Get lastLogin.
     *
     * @return DateTime lastLogin
     */
    public function getLastLogin();
 
    /**
     * Set lastLogin.
     *
     * @param DateTime $lastLogin the value to be set
     * @return UserInterface
     */
    public function setLastLogin(DateTime $lastLogin);
 
    /**
     * Get lastIp.
     *
     * @TODO: Map custom IP field type with inet_pton() and inet_ntop()
     * @param bool $long
     * @return lastIp
     */
    public function getLastIp($long = false);
 
    /**
     * Set lastIp.
     *
     * @TODO: Map custom IP field type with inet_pton() and inet_ntop()
     * @param $lastIp the value to be set
     * @return UserInterface
     */
    public function setLastIp($lastIp);
 
    /**
     * Get registerTime.
     *
     * @return DateTime registerTime
     */
    public function getRegisterTime();
 
    /**
     * Set registerTime.
     *
     * @param DateTime $registerTime the value to be set
     * @return UserInterface
     */
    public function setRegisterTime(DateTime $registerTime);
 
    /**
     * Get registerIp.
     *
     * @TODO: Map custom IP field type with inet_pton() and inet_ntop()
     * @param bool $long
     * @return registerIp
     */
    public function getRegisterIp($long = false);
 
    /**
     * Set registerIp.
     *
     * @TODO: Map custom IP field type with inet_pton() and inet_ntop()
     * @param $registerIp the value to be set
     * @return UserInterface
     */
    public function setRegisterIp($registerIp);
 
    /**
     * Get active.
     * 
     * @return bool
     */
    public function getActive();
 
    /**
     * Set active.
     *
     * @param bool $active the value to be set
     * @return UserInterface
     */
    public function setActive($active);
 
    /**
     * Get enabled.
     *
     * @return bool enabled
     */
    public function getEnabled();
 
    /**
     * Set enabled.
     *
     * @param bool $enabled the value to be set
     * @return UserInterface
     */
    public function setEnabled($enabled);

}
