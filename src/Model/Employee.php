<?php

/**
 * Created by PhpStorm.
 * User: brandenkaestner
 * Date: 6/29/16
 * Time: 3:46 PM
 */
class Employee extends AbstractPerson
{
    private $personType = "Employee";
    private $username  = "";
    private $password = "";
    private $onShift = false;

    /**
     * Client constructor.
     * @param $first
     * @param $last
     */
    public function __construct($first, $last)
    {
        parent::__construct($first, $last);
    }

    /**
     * @return string
     */
    public function getPersonType()
    {
        return $this->personType;
    }

    /**
     * @param string $personType
     */
    public function setPersonType($personType)
    {
        // TODO: Implement setPersonType() method.
        $this->personType = $personType;
    }
    
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return boolean
     */
    public function isOnShift()
    {
        return $this->onShift;
    }

    /**
     * @param boolean $onShift
     */
    public function setOnShift($onShift)
    {
        $this->onShift = $onShift;
    }

    /**
     * @return mixed
     */
    public function getSuperID()
    {
        return $this->superID;
    }

    /**
     * @param mixed $superID
     */
    public function setSuperID($superID)
    {
        $this->superID = $superID;
    }
    private $superID;

    
}