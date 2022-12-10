<?php

namespace src\DTO;

class SizeDTO
{
    private null|int $id;
    private string $code;
    private string $name;

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
}