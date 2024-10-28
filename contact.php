<?php
namespace fedex;

class Contact {
    private $personName;
    private $phoneNumber;
    private $companyName;

    public function __construct($personName, $phoneNumber, $companyName = null) {
        $this->personName = $personName;
        $this->phoneNumber = $phoneNumber;
        $this->companyName = $companyName;
    }

    public function getPersonName() {
        return $this->personName;
    }

    public function setPersonName($personName) {
        $this->personName = $personName;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function setCompanyName($companyName) {
        $this->companyName = $companyName;
    }

    public function toArray() {
        return [
            'personName' => $this->personName,
            'phoneNumber' => $this->phoneNumber,
            'companyName' => $this->companyName
        ];
    }
}
