<?php

namespace fedex;

class googleAddress
{
    private $streetNumber;
    private $route;
    private $locality; // city
    private $administrativeAreaLevel1; // state
    private $administrativeAreaLevel2; // county
    private $country;
    private $postalCode;
    private $formattedAddress;

    // Getters and setters for each field

    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function getLocality()
    {
        return $this->locality;
    }

    public function setLocality($locality)
    {
        $this->locality = $locality;
    }

    public function getAdministrativeAreaLevel1()
    {
        return $this->administrativeAreaLevel1;
    }

    public function setAdministrativeAreaLevel1($administrativeAreaLevel1)
    {
        $this->administrativeAreaLevel1 = $administrativeAreaLevel1;
    }

    public function getAdministrativeAreaLevel2()
    {
        return $this->administrativeAreaLevel2;
    }

    public function setAdministrativeAreaLevel2($administrativeAreaLevel2)
    {
        $this->administrativeAreaLevel2 = $administrativeAreaLevel2;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    public function setFormattedAddress($formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;
    }
}
