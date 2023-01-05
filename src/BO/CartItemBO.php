<?php

namespace src\BO;

use src\DAO\CartItemDAO;
use src\DTO\CartDTO;
use src\DTO\CartItemDTO;
use src\DTO\ProductStockDTO;
use src\Enums\CartEnum;
use src\Enums\FieldsEnum;
use src\Enums\OrderEnum;
use src\Enums\TableEnum;
use src\Exceptions\AttributesExceptions\AttributeAlreadyExistsException;
use src\Exceptions\AttributesExceptions\AttributeNotFoundException;
use src\Exceptions\CartExceptions\CartDontAllowInsertItensException;
use src\Exceptions\FieldsExceptions\InvalidFieldValueException;
use src\Exceptions\GenericExceptions\NotFoundException;
use src\Exceptions\ProductExceptions\InsufficientStockBalanceForItemException;
use src\Exceptions\ProductExceptions\OutOfStockItemException;
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

    public function validatePostParamsApi(array $paramsFields, \stdClass $item): void
    {
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateCartExistsInDbByCartId($item->cartId);
        $this->validateCartAllowInsertItemByCartId($item->cartId);
        $this->validateItemStockMustNotExistsInDbWithCartId($item);
        $this->validateStockExistsInDbByStockId($item->stockId);
        $this->validateStockHaveBalanceByStockId($item->stockId, $item->quantity);
    }

    public function validateCartExistsInDbByCartId(int $cartId): void
    {
        $cartBO = new CartBO();
        if (!$cartBO->countById($cartId)) {
            throw new AttributeNotFoundException(FieldsEnum::CART_ID_JSON);
        }
    }

    public function validateCartAllowInsertItemByCartId(int $cartId): void
    {
        $cartBO = new CartBO();
        if ($cartBO->validateOrderDoneByCartId($cartId)) {
            throw new CartDontAllowInsertItensException();
        }
    }

    public function validateItemStockMustNotExistsInDbWithCartId(\stdClass $item): void
    {
        if ($this->dao->countByColumnValueWithCartId(FieldsEnum::STOCK_ID_DB, $item->cartId, $item->cartId)) {
            throw new AttributeAlreadyExistsException(FieldsEnum::STOCK_ID_JSON);
        }
    }

    public function validateStockExistsInDbByStockId(int $stockId): void
    {
        $stockBO = new ProductStockBO();
        if (!$stockBO->countById($stockId)) {
            throw new AttributeNotFoundException(FieldsEnum::STOCK_ID_JSON);
        }
    }

    public function validateStockHaveBalanceByStockId(int $stockId, int $quantity): void
    {
        $stockBO = new ProductStockBO();
        /** @var ProductStockDTO $stock */
        $stock = $stockBO->findById($stockId);
        if ($stock->getQuantity() <= 0) {
            throw new OutOfStockItemException();
        }
        if ($stock->getQuantity() < $quantity) {
            throw new InsufficientStockBalanceForItemException();
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $item): void
    {
        if (!$this->dao->countByColumnValue(FieldsEnum::ID, $item->id)) {
            throw new NotFoundException();
        }
        $this->validateFieldsExist($paramsFields, $item);
    }

    public function validateOrderDoneByCartItemId(int $cartItemId): bool
    {
        /** @var CartItemDTO $item */
        $item = $this->findById($cartItemId);
        $cartBO = new CartBO();
        return $cartBO->validateOrderDoneByCartId($item->getCartId());
    }

    public function validateItensStockBalance(array $itens): void
    {
        foreach ($itens as $item) {
            if ($item->quantity <= 0) {
                throw new InvalidFieldValueException(FieldsEnum::QUANTITY . ' stock: ' . $item->getStockId());
            }
            if ($item->stock->quantity <= 0) {
                throw new OutOfStockItemException($item->stock->id);
            }
            if ($item->quantity > $item->stock->quantity) {
                throw new InsufficientStockBalanceForItemException($item->stock->id);
            }
        }
    }

    public function getTotalItensAndValueOnCartId(int $cartId): array
    {
        $itens = $this->findAllByCartId($cartId);
        $quantity = 0;
        $value = 0;
        foreach ($itens as $item) {
            $quantity = $quantity + $item->quantity;
            $value = $value + ($item->stock->price * $item->quantity);
        }
        return array('totalItens' => $quantity, 'totalValue' => $value);
    }

    public function updateStockItensPurchaseByCartId(int $cartId): void
    {
        $productStockBO = new ProductStockBO();
        $itens = $this->findAllByCartId($cartId);
        foreach ($itens as $item) {
            $productStockBO->decreaseStockBalanceByStockId($item->stock->id, $item->quantity);
        }
    }

    public function validateStockIsNotCartDone(int $stockId): bool
    {
        $cartItens = $this->findAllByStockId($stockId);
        if (!$cartItens) {
            return true;
        }
        $cartBO = new CartBO();
        /** @var CartItemDTO $cartItem */
        foreach ($cartItens as $cartItem) {
            /** @var CartDTO $cart */
            $cart = $cartBO->findById($cartItem->getCartId());
            if ($cart->getOrderDone() == CartEnum::ORDER_DONE) {
                return false;
            }
        }
        return true;
    }

    public function findAllByStockId(int $stockId): null|array
    {
        $itensFind = $this->dao->findAllByStockId($stockId);
        if (!$itensFind) {
            return null;
        }
        $itens = array();
        foreach ($itensFind as $itemFind) {
            $itens[] = $this->factory->populateDbToDto($itemFind);
        }
        return $itens;
    }

    public function deleteByStockId(int $stockId): void
    {
        $this->dao->deleteByStockId($stockId);
    }
}