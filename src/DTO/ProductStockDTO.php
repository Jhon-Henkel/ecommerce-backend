<?php

namespace src\DTO;

class ProductStockDTO
{
    private int $id;
    private string $code;
    private int $quantity;
    private int $colorId;
    private int $sizeId;
    private int $bandId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
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
}