<?php

namespace src\DTO;

use DateTime;

class OrderDataDTO
{
    private null|int $id;
    private null|string $code;
    private string $clientName;
    private int $clientDocumentType;
    private string $clientDocument;
    private null|string $clientMainPhone;
    private null|string $clientSecondPhone;
    private string $clientEmail;
    private string $addressStreet;
    private string $addressZipCode;
    private null|int $addressNumber;
    private null|string $addressComplement;
    private string $addressDistrict;
    private string $addressCity;
    private string $addressState;
    private null|string $addressReference;
    private int $status;
    private int $cartId;
    private int $totalItensQuantity;
    private null|string $giftCardCode;
    private null|float $giftCardValue;
    private null|float $shippingValue;
    private float $totalItensValue;
    private null|float $extraFareValue;
    private float $totalValue;
    private null|int $shippingDeadline;
    private null|DateTime $createdAt;
    private null|DateTime $updatedAt;

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
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     */
    public function setClientName(string $clientName): void
    {
        $this->clientName = $clientName;
    }

    /**
     * @return int
     */
    public function getClientDocumentType(): int
    {
        return $this->clientDocumentType;
    }

    /**
     * @param int $clientDocumentType
     */
    public function setClientDocumentType(int $clientDocumentType): void
    {
        $this->clientDocumentType = $clientDocumentType;
    }

    /**
     * @return string
     */
    public function getClientDocument(): string
    {
        return $this->clientDocument;
    }

    /**
     * @param string $clientDocument
     */
    public function setClientDocument(string $clientDocument): void
    {
        $this->clientDocument = $clientDocument;
    }

    /**
     * @return string|null
     */
    public function getClientMainPhone(): ?string
    {
        return $this->clientMainPhone;
    }

    /**
     * @param string|null $clientMainPhone
     */
    public function setClientMainPhone(?string $clientMainPhone): void
    {
        $this->clientMainPhone = $clientMainPhone;
    }

    /**
     * @return string|null
     */
    public function getClientSecondPhone(): ?string
    {
        return $this->clientSecondPhone;
    }

    /**
     * @param string|null $clientSecondPhone
     */
    public function setClientSecondPhone(?string $clientSecondPhone): void
    {
        $this->clientSecondPhone = $clientSecondPhone;
    }

    /**
     * @return string
     */
    public function getClientEmail(): string
    {
        return $this->clientEmail;
    }

    /**
     * @param string $clientEmail
     */
    public function setClientEmail(string $clientEmail): void
    {
        $this->clientEmail = $clientEmail;
    }

    /**
     * @return string
     */
    public function getAddressStreet(): string
    {
        return $this->addressStreet;
    }

    /**
     * @param string $addressStreet
     */
    public function setAddressStreet(string $addressStreet): void
    {
        $this->addressStreet = $addressStreet;
    }

    /**
     * @return string
     */
    public function getAddressZipCode(): string
    {
        return $this->addressZipCode;
    }

    /**
     * @param string $addressZipCode
     */
    public function setAddressZipCode(string $addressZipCode): void
    {
        $this->addressZipCode = $addressZipCode;
    }

    /**
     * @return int|null
     */
    public function getAddressNumber(): ?int
    {
        return $this->addressNumber;
    }

    /**
     * @param int|null $addressNumber
     */
    public function setAddressNumber(?int $addressNumber): void
    {
        $this->addressNumber = $addressNumber;
    }

    /**
     * @return string|null
     */
    public function getAddressComplement(): ?string
    {
        return $this->addressComplement;
    }

    /**
     * @param string|null $addressComplement
     */
    public function setAddressComplement(?string $addressComplement): void
    {
        $this->addressComplement = $addressComplement;
    }

    /**
     * @return string
     */
    public function getAddressDistrict(): string
    {
        return $this->addressDistrict;
    }

    /**
     * @param string $addressDistrict
     */
    public function setAddressDistrict(string $addressDistrict): void
    {
        $this->addressDistrict = $addressDistrict;
    }

    /**
     * @return string
     */
    public function getAddressCity(): string
    {
        return $this->addressCity;
    }

    /**
     * @param string $addressCity
     */
    public function setAddressCity(string $addressCity): void
    {
        $this->addressCity = $addressCity;
    }

    /**
     * @return string
     */
    public function getAddressState(): string
    {
        return $this->addressState;
    }

    /**
     * @param string $addressState
     */
    public function setAddressState(string $addressState): void
    {
        $this->addressState = $addressState;
    }

    /**
     * @return string|null
     */
    public function getAddressReference(): ?string
    {
        return $this->addressReference;
    }

    /**
     * @param string|null $addressReference
     */
    public function setAddressReference(?string $addressReference): void
    {
        $this->addressReference = $addressReference;
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
     * @return int
     */
    public function getCartId(): int
    {
        return $this->cartId;
    }

    /**
     * @param int $cartId
     */
    public function setCartId(int $cartId): void
    {
        $this->cartId = $cartId;
    }

    /**
     * @return int
     */
    public function getTotalItensQuantity(): int
    {
        return $this->totalItensQuantity;
    }

    /**
     * @param int $totalItensQuantity
     */
    public function setTotalItensQuantity(int $totalItensQuantity): void
    {
        $this->totalItensQuantity = $totalItensQuantity;
    }

    /**
     * @return string|null
     */
    public function getGiftCardCode(): ?string
    {
        return $this->giftCardCode;
    }

    /**
     * @param string|null $giftCardCode
     */
    public function setGiftCardCode(?string $giftCardCode): void
    {
        $this->giftCardCode = $giftCardCode;
    }

    /**
     * @return float|null
     */
    public function getGiftCardValue(): ?float
    {
        return $this->giftCardValue;
    }

    /**
     * @param float|null $giftCardValue
     */
    public function setGiftCardValue(?float $giftCardValue): void
    {
        $this->giftCardValue = $giftCardValue;
    }

    /**
     * @return float|null
     */
    public function getShippingValue(): ?float
    {
        return $this->shippingValue;
    }

    /**
     * @param float|null $shippingValue
     */
    public function setShippingValue(?float $shippingValue): void
    {
        $this->shippingValue = $shippingValue;
    }

    /**
     * @return float
     */
    public function getTotalItensValue(): float
    {
        return $this->totalItensValue;
    }

    /**
     * @param float $totalItensValue
     */
    public function setTotalItensValue(float $totalItensValue): void
    {
        $this->totalItensValue = $totalItensValue;
    }

    /**
     * @return float|null
     */
    public function getExtraFareValue(): ?float
    {
        return $this->extraFareValue;
    }

    /**
     * @param float|null $extraFareValue
     */
    public function setExtraFareValue(?float $extraFareValue): void
    {
        $this->extraFareValue = $extraFareValue;
    }

    /**
     * @return float
     */
    public function getTotalValue(): float
    {
        return $this->totalValue;
    }

    /**
     * @param float $totalValue
     */
    public function setTotalValue(float $totalValue): void
    {
        $this->totalValue = $totalValue;
    }

    /**
     * @return int|null
     */
    public function getShippingDeadline(): ?int
    {
        return $this->shippingDeadline;
    }

    /**
     * @param int|null $shippingDeadline
     */
    public function setShippingDeadline(?int $shippingDeadline): void
    {
        $this->shippingDeadline = $shippingDeadline;
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