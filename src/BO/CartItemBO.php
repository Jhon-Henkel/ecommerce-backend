<?php

namespace src\BO;

use src\DAO\CartItemDAO;
use src\DTO\ProductStockDTO;
use src\Enums\TableEnum;
use src\Factory\CartItemDtoFactory;

class CartItemBO extends BasicBO
{
    public CartItemDAO $dao;
    public CartItemDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new CartItemDAO(TableEnum::CART_ITEM);
        $this->factory = new CartItemDtoFactory();
    }

    public function findAllByCartId(int $cartId): null|array
    {
        $itens = $this->dao->findAllByCartId($cartId);
        if (!$itens) {
            return null;
        }
        $itens = $this->factory->makeItensPublic($itens);
        return $this->getItensWithStock($itens);
    }

    /**
     * @param array $itens
     * @return array
     */
    public function getItensWithStock(array $itens): array
    {
        $itemStockBO = new ProductStockBO();
        $itensWithStock = array();
        foreach ($itens as $item) {
            /** @var  ProductStockDTO|null $stock */
            $stock = $itemStockBO->findById($item->stockId);
            if (!$stock || $stock->getQuantity() <= 0) {
                $itensWithStock[$item->stockId] = 'Out Of Stock';
                continue;
            }
            unset($item->stockId);
            unset($item->cartId);
            $item->stock = $itemStockBO->factory->makePublic($stock);
            $itensWithStock[] = $item;
        }
        return $itensWithStock;
    }

    public function deleteByCartId(int $cartId): void
    {
        $this->dao->deleteByCartId($cartId);
    }
}