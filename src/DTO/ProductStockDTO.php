<?php

namespace src\DTO;

use DateTime;

class ProductStockDTO
{
    private  null|int $id;
    private string $code;
    private string $name;
    private int $quantity;
    private int $colorId;
    private int $sizeId;
    private int $bandId;
    private int $productId;
    private float $price;
    private int $width;
    private int $height;
    private int $length;
    private int $grossWeight;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    /**
     * @return null|int
     */
    public function getId(): null|int
    {
        return $this->id;
    }

    /**
     * @param null|int $id
     */
    public function setId(null|int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getColorId(): int
    {
        return $this->colorId;
    }

    /**
     * @param int $colorId
     */
    public function setColorId(int $colorId): void
    {
        $this->colorId = $colorId;
    }

    /**
     * @return int
     */
    public function getSizeId(): int
    {
        return $this->sizeId;
    }

    /**
     * @param int $sizeId
     */
    public function setSizeId(int $sizeId): void
    {
        $this->sizeId = $sizeId;
    }

    /**
     * @return int
     */
    public function getBandId(): int
    {
        return $this->bandId;
    }

    /**
     * @param int $bandId
     */
    public function setBandId(int $bandId): void
    {
        $this->bandId = $bandId;
    }

    /**
    * @return int
    */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
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

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     */
    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}