<?php

/**
 * Created by PhpStorm.
 * User: brandenkaestner
 * Date: 6/29/16
 * Time: 3:41 PM
 */
abstract class AbstractPerson
{

    private $personID;
    private $firstName = "";
    private $lastName = "";
    private $address = "";
    private $cellNum = 0;
    private $workNum = 0;

    /**
     * Client constructor.
     * @param $first
     * @param $last
     */
    public function __construct($first, $last)
    {
        $this->firstName = $first;
        $this->lastName = $last;
    }

    /**
     * @return int
     */
    public function getPersonID()
    {
        return $this->personID;
    }

    /**
     * @param int $personID
     */
    public function setPersonID($personID)
    {
        $this->personID = $personID;
    }

    /**
     * @param string $personType
     */
    abstract public function setPersonType($personType);

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getCellNum()
    {
        return $this->cellNum;
    }

    /**
     * @param int $cellNum
     */
    public function setCellNum($cellNum)
    {
        $this->cellNum = $cellNum;
    }

    /**
     * @return int
     */
    public function getWorkNum()
    {
        return $this->workNum;
    }

    /**
     * @param int $workNum
     */
    public function setWorkNum($workNum)
    {
        $this->workNum = $workNum;
    }
}