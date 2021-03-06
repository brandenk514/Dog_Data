<?php

/**
 * Created by PhpStorm.
 * User: brandenkaestner
 * Date: 6/29/16
 * Time: 3:28 PM
 */
class Cat extends AbstractAnimal
{
    private $species = "Cat";

    /**
     * Cat constructor.
     * @param $name
     */
    public function __construct($name)
    {
        parent::__construct($name);
    }

    /**
     * @return string
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @param $species
     * @return string|void
     */
    public function setSpecies($species)
    {
        // TODO: Implement setBreed() method.
        $this->species = $species;
    }
}