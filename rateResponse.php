<?php

namespace fedex;

class rateResponse {
    private $totalNetCharge;
    private $deliveryDate;
    private $deliveryDay;
    private $transitTime;
    private $serviceName;

    public function __construct(
        float $totalNetCharge,
        string $deliveryDate,
        string $deliveryDay,
        string $transitTime,
        string $serviceName
    ) {
        $this->totalNetCharge = $totalNetCharge;
        $this->deliveryDate = $deliveryDate;
        $this->deliveryDay = $deliveryDay;
        $this->transitTime = $transitTime;
        $this->serviceName = $serviceName;
    }

    public function getTotalNetCharge()
    {
        return $this->totalNetCharge;
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