<?php

namespace src\DTO;

use DateTime;

class AddressDTO
{
    private int $id;
    private int $clientId;
    private string $street;
    private string $zipCode;
    private null|int $addressNumber;
    private null|string $complement;
    private string $district;
    private string $city;
    private string $state;
    private string $reference;
    private null|DateTime $createdAt;
    private null|DateTime $updatedAt;

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
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
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
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * @param string|null $complement
     */
    public function setComplement(?string $complement): void
    {
        $this->complement = $complement;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @param string $district
     */
    public function setDistrict(string $district): void
    {
        $this->district = $district;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): DateTime|null
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     */
    public function setCreatedAt(DateTime|null $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): DateTime|null
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(DateTime|null $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}