<?php

namespace src\DTO;

class ShippingCalculatedDTO
{
    public string $shippingCompany;
    public string $serviceType;
    public int $deliveryTimeInDays;
    public float $price;
    public int $height;
    public int $width;
    public int $length;
    public int $grossWeight;

    /**
     * @return string
     */
    public function getShippingCompany(): string
    {
        return $this->shippingCompany;
    }

    /**
     * @param string $shippingCompany
     */
    public function setShippingCompany(string $shippingCompany): void
    {
        $this->shippingCompany = $shippingCompany;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @param string $serviceType
     */
    public function setServiceType(string $serviceType): void
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @return int
     */
    public function getDeliveryTimeInDays(): int
    {
        return $this->deliveryTimeInDays;
    }

    /**
     * @param int $deliveryTimeInDays
     */
    public function setDeliveryTimeInDays(int $deliveryTimeInDays): void
    {
        $this->deliveryTimeInDays = $deliveryTimeInDays;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getGrossWeight(): int
    {
        return $this->grossWeight;
    }

    /**
     * @param int $grossWeight
     */
    public function setGrossWeight(int $grossWeight): void
    {
        $this->grossWeight = $grossWeight;
    }
}