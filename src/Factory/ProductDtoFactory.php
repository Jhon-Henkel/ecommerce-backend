<?php

namespace src\Factory;

use src\DTO\ProductDTO;
use src\Tools\StringTools;

class ProductDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $item): ProductDTO
    {
        $productFactored = new ProductDTO();
        $productFactored->setId($item->id ?? null);
        $productFactored->setName($item->name);
        $productFactored->setCode($item->code);
        $productFactored->setCategoryId($item->categoryId);
        $productFactored->setDescription($item->description ?? null);
        $productFactored->setUrl($item->url ?? $this->factoryUrl($item));
        return $productFactored;
    }

    public function populateDbToDto(array $item): ProductDTO
    {
        $productDTO = new ProductDTO();
        $productDTO->setId($item['product_id']);
        $productDTO->setName($item['product_name']);
        $productDTO->setCode($item['product_code']);
        $productDTO->setCategoryId($item['product_category_id']);
        $productDTO->setDescription($item['product_description']);
        $productDTO->setUrl($item['product_url']);
        return $productDTO;
    }

    public function factoryUrl(\stdClass $product): string
    {
        $name = StringTools::replaceSpacesInDashes($product->name);
        $code = StringTools::replaceSpacesInDashes($product->code);
        return strtolower($code) . '/' . strtolower($name);
    }

    /**
     * @param ProductDTO $item
     * @return \stdClass
     */
    public function makePublic($item): \stdClass
    {
        $productFactored = new \stdClass();
        $productFactored->id = $item->getId();
        $productFactored->name = $item->getName();
        $productFactored->code = $item->getCode();
        $productFactored->categoryId = $item->getCategoryId();
        $productFactored->description = $item->getDescription();
        $productFactored->url = $item->getUrl();
        return $productFactored;
    }

    public function factoryProductWithStockPublic(ProductDTO $product, array $stocks): \stdClass
    {
        $productFactored = $this->makePublic($product);
        $productFactored->stocks = $stocks;
        return $productFactored;
    }
}