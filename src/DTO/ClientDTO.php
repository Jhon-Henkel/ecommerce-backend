<?php

namespace src\DTO;

use DateTime;

class ClientDTO
{
    private null|int $id;
    private string $name;
    private int $documentType;
    private string $document;
    private null|string $mainPhone;
    private null|string $secondPhone;
    private string $email;
    private DateTime $birthDate;
    private string $password;
    private null|DateTime $createdAt;
    private null|DateTime $updatedAt;

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
    public function getDocumentType(): int
    {
        return $this->documentType;
    }

    /**
     * @param int $documentType
     */
    public function setDocumentType(int $documentType): void
    {
        $this->documentType = $documentType;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * @param string $document
     */
    public function setDocument(string $document): void
    {
        $this->document = $document;
    }

    /**
     * @return string|null
     */
    public function getMainPhone(): ?string
    {
        return $this->mainPhone;
    }

    /**
     * @param string|null $mainPhone
     */
    public function setMainPhone(?string $mainPhone): void
    {
        $this->mainPhone = $mainPhone;
    }

    /**
     * @return string|null
     */
    public function getSecondPhone(): ?string
    {
        return $this->secondPhone;
    }

    /**
     * @param string|null $secondPhone
     */
    public function setSecondPhone(?string $secondPhone): void
    {
        $this->secondPhone = $secondPhone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return DateTime
     */
    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param DateTime $birthDate
     */
    public function setBirthDate(DateTime $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
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