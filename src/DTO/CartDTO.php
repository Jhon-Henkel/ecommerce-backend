<?php

namespace src\DTO;

class CartDTO
{
    private null|int $id;
    private int $clientId;
    private int $orderDone;
    private string $hash;
    private null|int $giftCardId;
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
     * @return int
     */
    public function getOrderDone(): int
    {
        return $this->orderDone;
    }

    /**
     * @param int $orderDone
     */
    public function setOrderDone(int $orderDone): void
    {
        $this->orderDone = $orderDone;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return int|null
     */
    public function getGiftCardId(): ?int
    {
        return $this->giftCardId;
    }

    /**
     * @param int|null $giftCardId
     */
    public function setGiftCardId(?int $giftCardId): void
    {
        $this->giftCardId = $giftCardId;
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