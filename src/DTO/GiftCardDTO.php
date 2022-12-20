<?php

namespace src\DTO;

class GiftCardDTO
{
    private null|int $id;
    private string $code;
    private int $discountType;
    private float $discount;
    private int $usages;
    private int $maxUsages;
    private int $status;
    private null|\DateTime $createdAt;
    private null|\DateTime $updatedAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
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
    public function getDiscountType(): int
    {
        return $this->discountType;
    }

    /**
     * @param int $discountType
     */
    public function setDiscountType(int $discountType): void
    {
        $this->discountType = $discountType;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return int
     */
    public function getUsages(): int
    {
        return $this->usages;
    }

    /**
     * @param int $usages
     */
    public function setUsages(int $usages): void
    {
        $this->usages = $usages;
    }

    /**
     * @return int
     */
    public function getMaxUsages(): int
    {
        return $this->maxUsages;
    }

    /**
     * @param int $maxUsages
     */
    public function setMaxUsages(int $maxUsages): void
    {
        $this->maxUsages = $maxUsages;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     */
    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}