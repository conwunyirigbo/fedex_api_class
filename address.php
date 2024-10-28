<?php

namespace fedex;

class Address {
    private $streetLines;
    private $city;
    private $stateOrProvinceCode;
    private $postalCode;
    private $countryCode;
    private $residential;

    public function __construct(array $streetLines, $city, $stateOrProvinceCode, $postalCode, $countryCode, $residential = true) {
        $this->streetLines = $streetLines;
        $this->city = $city;
        $this->stateOrProvinceCode = $stateOrProvinceCode;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
        $this->residential = $residential;
    }

    public function getStreetLines() {
        return $this->streetLines;
    }

    public function setStreetLines($streetLines) {
        $this->streetLines = $streetLines;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getStateOrProvinceCode() {
        return $this->stateOrProvinceCode;
    }

    public function setStateOrProvinceCode($stateOrProvinceCode) {
        $this->stateOrProvinceCode = $stateOrProvinceCode;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function getCountryCode() {
        return $this->countryCode;
    }

    public function setCountryCode($countryCode) {
        $this->countryCode = $countryCode;
    }

    public function getResidential() {
        return $this->residential;
    }

    public function setResidential($residential) {
        $this->residential = $residential;
    }

    public function toArray() {
        return [
            'streetLines' => $this->streetLines,
            'city' => $this->city,
            'stateOrProvinceCode' => $this->stateOrProvinceCode,
            'postalCode' => $this->postalCode,
            'countryCode' => $this->countryCode,
            'residential' => $this->residential
        ];
    }
}
