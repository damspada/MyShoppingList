<?php

namespace Mattiaricciardelli\MyShoppingList\Management_Supermarkets;

class Supermarket
{
    private $chain;
    private $name;
    private $latitude;
    private $longitude;

    public function __construct($chain, $name, $latitude, $longitude)
    {
        $this->chain = $chain;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    // Getters
    public function getChain()
    {
        return $this->chain;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    // Setters
    public function setChain($chain)
    {
        $this->chain = $chain;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
}