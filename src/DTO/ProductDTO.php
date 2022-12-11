<?php

namespace src\DTO;

class ProductDTO
{
    private null|int $id;
    private string $code;
    private string $name;
    private string $url;
    private null|string $description;
    private int $categoryId;

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
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return null|string
     */
    public function getDescription(): null|string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(null|string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
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

}