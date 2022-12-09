<?php

namespace src\DTO;

class CategoryDTO
{
    private null|int $id;
    private string $code;
    private string $name;
    private null|int $fatherId;

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
     * @return null|int
     */
    public function getFatherId(): null|int
    {
        return $this->fatherId;
    }

    /**
     * @param null|int $fatherId
     */
    public function setFatherId(null|int $fatherId): void
    {
        $this->fatherId = $fatherId;
    }

}