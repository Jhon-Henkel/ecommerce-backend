<?php

namespace src\DTO;

class CategoryDTO
{
    private int $id;
    private string $code;
    private string $name;
    private int $fatherId;

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
    public function getFatherId(): int
    {
        return $this->fatherId;
    }

    /**
     * @param int $fatherId
     */
    public function setFatherId(int $fatherId): void
    {
        $this->fatherId = $fatherId;
    }

}