<?php

namespace src\Factory;

use Exception;
use src\DTO\ProductDTO;
use src\Tools\DateTools;
use src\Tools\StringTools;
use stdClass;

class ProductDtoFactory extends BasicDtoFactory
{
    /**
     * @throws Exception
     */
    public function factory(stdClass $item): ProductDTO
    {
        if (!isset($item->createdAt)) {
            $item->createdAt = null;
        }
        if (!isset($item->updatedAt)) {
            $item->updatedAt = null;
        }
        $productFactored = new ProductDTO();
        $productFactored->setId($item->id ?? null);
        $productFactored->setName($item->name);
        $productFactored->setCode($item->code);
        $productFactored->setCategoryId($item->categoryId);
        $productFactored->setDescription($item->description ?? null);
        $productFactored->setUrl($item->url ?? $this->factoryUrl($item));
        $productFactored->setCreatedAt(DateTools::stringToDateTimeConverter($item->createdAt));
        $productFactored->setUpdatedAt(DateTools::stringToDateTimeConverter($item->updatedAt));
        return $productFactored;
    }

    /**
     * @throws Exception
     */
    public function populateDbToDto(array $item): ProductDTO
    {
        $productDTO = new ProductDTO();
        $productDTO->setId($item['product_id']);
        $productDTO->setName($item['product_name']);
        $productDTO->setCode($item['product_code']);
        $productDTO->setCategoryId($item['product_category_id']);
        $productDTO->setDescription($item['product_description']);
        $productDTO->setUrl($item['product_url']);
        $productDTO->setCreatedAt(DateTools::stringToDateTimeConverter($item['product_created_at']));
        $productDTO->setUpdatedAt(DateTools::stringToDateTimeConverter($item['product_updated_at']));
        return $productDTO;
    }

    public function factoryUrl(stdClass $product): string
    {
        $name = StringTools::replaceSpacesInDashes($product->name);
        $code = StringTools::replaceSpacesInDashes($product->code);
        return strtolower($code) . '/' . strtolower($name);
    }

    /**
     * @param ProductDTO $item
     * @return stdClass
     */
    public function makePublic($item): stdClass
    {
        $productFactored = new stdClass();
        $productFactored->id = $item->getId();
        $productFactored->name = $item->getName();
        $productFactored->code = $item->getCode();
        $productFactored->categoryId = $item->getCategoryId();
        $productFactored->description = $item->getDescription();
        $productFactored->url = $item->getUrl();
        $productFactored->createdAt = DateTools::dateTimeToStringConverter($item->getCreatedAt());
        $productFactored->updatedAt = DateTools::dateTimeToStringConverter($item->getUpdatedAt());
        return $productFactored;
    }

    public function factoryProductWithStockPublic(ProductDTO $product, array $stocks): stdClass
    {
        $productFactored = $this->makePublic($product);
        $productFactored->stocks = $stocks;
        return $productFactored;
    }
}