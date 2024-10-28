<?php
namespace fedex;

class shippingResponse {
    private $masterTrackingNumber;
    private $transactionId;
    private $customerTransactionId;
    private $deliveryDate;
    private $deliveryDay;
    private $transitTime;
    private $serviceName;

    public function __construct(
        float $masterTrackingNumber,
        string $transactionId,
        string $customerTransactionId,
        string $deliveryDate,
        string $deliveryDay,
        string $transitTime,
        string $serviceName
    ) {
        $this->masterTrackingNumber = $masterTrackingNumber;
        $this->transactionId = $transactionId;
        $this->customerTransactionId = $customerTransactionId;
        $this->deliveryDate = $deliveryDate;
        $this->deliveryDay = $deliveryDay;
        $this->transitTime = $transitTime;
        $this->serviceName = $serviceName;
    }

    public function getMasterTrackingNumber()
    {
        return $this->masterTrackingNumber;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function getCustomerTransactionId()
    {
        return $this->customerTransactionId;
    }

    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    public function getDeliveryDay()
    {
        return $this->deliveryDay;
    }

    public function getTransitTime()
    {
        return $this->transitTime;
    }

    public function getServiceName()
    {
        return $this->serviceName;
    }
}