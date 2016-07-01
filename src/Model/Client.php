<?php

/**
 * Created by PhpStorm.
 * User: brandenkaestner
 * Date: 6/29/16
 * Time: 3:00 PM
 */
class Client extends AbstractPerson 
{
    private $personType = "Client";

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
}