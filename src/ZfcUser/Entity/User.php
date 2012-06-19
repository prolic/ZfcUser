<?php

namespace ZfcUser\Entity;

use DateTime;

class User implements UserInterface
{
    protected $id;

    protected $username;

    protected $emailAddress;

    protected $displayName;

    protected $password;

    protected $lastLogin;

    protected $lastIp;

    protected $registerTime;

    protected $registerIp;

    protected $active;

    protected $enabled;
 
    /**
     * Get user_id.
     *
     * @return int user_id
     */
    public function getId()
    {
        return $this->id;
    }
 
    /**
     * Set user_id.
     *
     * @param int $userId the value to be set
     * @return User
     */
    public function setId($userId)
    {
        $this->id = (int) $userId;
        return $this;
    }
 
    /**
     * Get username.
     *
     * @return string username
     */
    public function getUsername()
    {
        return $this->username;
    }
 
    /**
     * Set username.
     *
     * @param string $username the value to be set
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
 
    /**
     * Get email address
     *
     * @return string email address
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }
 
    /**
     * Set email address
     *
     * @param string $emailAddress the value to be set
     * @return User
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }
 
    /**
     * Get display_name.
     *
     * @return string display_name
     */
    public function getDisplayName()
    {
        if ($this->displayName !== null) {
            return $this->displayName;
        } elseif ($this->username !== null) {
            return $this->username;
        } elseif ($this->emailAddress !== null) {
            return $this->emailAddress;
        }
        return null;
    }
 
    /**
     * Set display_name.
     *
     * @param string $displayName the value to be set
     * @return User
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }
 
    /**
     * Get password.
     *
     * @return string password
     */
    public function getPassword()
    {
        return $this->password;
    }
 
    /**
     * Set password.
     *
     * @param string $password the value to be set
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
 
    /**
     * Get last_login.
     *
     * @return DateTime last_login
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
 
    /**
     * Set last_login.
     *
     * @param DateTime $lastLogin the value to be set
     * @return User
     */
    public function setLastLogin(DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }
 
    /**
     * Get last_ip.
     *
     * @TODO: Map custom IP field type with inet_pton() and inet_ntop()
     * @param bool $long
     * @return last_ip
     */
    public function getLastIp($long = false)
    {
        if (true === $long) {
            return $this->lastIp;
        }
        return long2ip($this->lastIp);
    }
 
    /**
     * Set last_ip.
     *
     * @TODO: Map custom IP field type with inet_pton() and inet_ntop()
     * @param $lastIp the value to be set
     * @return User
     */
    public function setLastIp($lastIp)
    {
        $this->lastIp = ip2long($lastIp);
        return $this;
    }
 
    /**
     * Get register_time.
     *
     * @return DateTime register_time
     */
    public function getRegisterTime()
    {
        return $this->registerTime;
    }
 
    /**
     * Set register_time.
     *
     * @param DateTime $registerTime the value to be set
     * @return User
     */
    public function setRegisterTime(DateTime $registerTime)
    {
        $this->registerTime = $registerTime;
        return $this;
    }
 
    /**
     * Get register_ip.
     *
     * @TODO: Map custom IP field type with inet_pton() and inet_ntop()
     * @param bool $long
     * @return register_ip
     */
    public function getRegisterIp($long = false)
    {
        if (true === $long) {
            return $this->registerIp;
        }
        return long2ip($this->registerIp);
    }
 
    /**
     * Set register_ip.
     *
     * @TODO: Map custom IP field type with inet_pton() and inet_ntop()
     * @param $registerIp the value to be set
     * @return User
     */
    public function setRegisterIp($registerIp)
    {
        $this->registerIp = ip2long($registerIp);
        return $this;
    }
 
    /**
     * Get active.
     *
     * @return bool active
     */
    public function getActive()
    {
        return $this->active;
    }
 
    /**
     * Set active.
     *
     * @param bool $active the value to be set
     * @return User
     */
    public function setActive($active)
    {
        $this->active = (bool) $active;
        return $this;
    }
 
    /**
     * Get enabled.
     *
     * @return bool enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
 
    /**
     * Set enabled.
     *
     * @param bool $enabled the value to be set
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;
        return $this;
    }
}
