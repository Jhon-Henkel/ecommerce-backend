<?php

namespace src\DTO;

class ShippingPackageDTO
{
    private int|float $grossWeight;
    private int $length;
    private int $height;
    private int $width;

    /**
     * @return int|float
     */
    public function getGrossWeight(): int|float
    {
        return $this->grossWeight;
    }

    /**
     * @param int|float $grossWeight
     */
    public function setGrossWeight(int|float $grossWeight): void
    {
        $this->grossWeight = $grossWeight;
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
}