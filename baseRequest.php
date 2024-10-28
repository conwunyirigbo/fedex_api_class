<?php

namespace fedex;

use fedex\Address;
use fedex\Contact;

class baseRequest {
    private Contact $shipperContact;
    private Contact $recipientContact;
    private Address $shipperAddress;
    private Address $recipientAddress;
    private string $accountNo;
    private ?string $shipDatestamp;
    private ?string $pickupType;
    private ?string $serviceType;
    private ?string $packagingType;
    private array $requestedPackageLineItems;
    private ?string $preferredCurrency;

    public function __construct(
        Contact $shipperContact,
        Contact $recipientContact,
        Address $shipperAddress,
        Address $recipientAddress,
        string $accountNo,
        ?string $shipDatestamp = null,
        ?string $pickupType = "USE_SCHEDULED_PICKUP",
        ?string $serviceType = "GROUND_HOME_DELIVERY",
        ?string $packagingType = "YOUR_PACKAGING",
        array $requestedPackageLineItems = [],
        ?string $preferredCurrency = "USD",
    ) {
        $this->shipperContact = $shipperContact;
        $this->recipientContact = $recipientContact;
        $this->shipperAddress = $shipperAddress;
        $this->recipientAddress = $recipientAddress;
        $this->accountNo = $accountNo;
        $this->shipDatestamp = $shipDatestamp;
        $this->pickupType = $pickupType;
        $this->serviceType = $serviceType;
        $this->packagingType = $packagingType;
        $this->requestedPackageLineItems = $requestedPackageLineItems;
        $this->preferredCurrency = $preferredCurrency;
    }

    public function getShipperContact(): Contact {
        return $this->shipperContact;
    }

    public function setShipperContact(Contact $shipperContact): void {
        $this->shipperContact = $shipperContact;
    }

    public function getRecipientContact(): Contact {
        return $this->recipientContact;
    }

    public function setRecipientContact(Contact $recipientContact): void {
        $this->recipientContact = $recipientContact;
    }

    public function getShipperAddress(): Address {
        return $this->shipperAddress;
    }

    public function setShipperAddress(Address $shipperAddress): void {
        $this->shipperAddress = $shipperAddress;
    }

    public function getRecipientAddress(): Address {
        return $this->recipientAddress;
    }

    public function setRecipientAddress(Address $recipientAddress): void {
        $this->recipientAddress = $recipientAddress;
    }

    public function getAccountNo(): string {
        return $this->accountNo;
    }

    public function setAccountNo(string $accountNo): void {
        $this->accountNo = $accountNo;
    }

    public function getShipDatestamp(): ?string {
        return $this->shipDatestamp ?? date('Y-m-d');
    }

    public function setShipDatestamp(?string $shipDatestamp): void {
        $this->shipDatestamp = $shipDatestamp;
    }

    public function getPickupType(): ?string {
        return $this->pickupType;
    }

    public function setPickupType(?string $pickupType): void {
        $this->pickupType = $pickupType;
    }

    public function getServiceType(): ?string {
        return $this->serviceType;
    }

    public function setServiceType(?string $serviceType): void {
        $this->serviceType = $serviceType;
    }

    public function getPackagingType(): ?string {
        return $this->packagingType;
    }

    public function setPackagingType(?string $packagingType): void {
        $this->packagingType = $packagingType;
    }

    public function getRequestedPackageLineItems(): array {
        return $this->requestedPackageLineItems;
    }

    public function setRequestedPackageLineItems(array $packageLines = []): void {
        $this->requestedPackageLineItems = $packageLines;
    }

    public function getPreferredCurrency(): string {
        return $this->preferredCurrency;
    }

    public function setPreferredCurrency(string $currency): void {
        $this->preferredCurrency = $currency;
    }

    public function toArray(): array {
        return [
            'accountNo' => $this->accountNo,
            'shipDatestamp' => $this->shipDatestamp,
            'pickupType' => $this->pickupType,
            'serviceType' => $this->serviceType,
            'packagingType' => $this->packagingType,
        ];
    }
}
