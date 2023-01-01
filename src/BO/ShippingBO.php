<?php

namespace src\BO;

use src\DTO\ShippingPackageDTO;
use src\Enums\FieldsEnum;
use src\Exceptions\GenericExceptions\NotFoundException;
use src\Exceptions\GenericExceptions\UnableToCalculateShipping;
use src\Exceptions\ShippingExceptions\InvalidParamCalculateException;
use src\Factory\ShippingFactory;

class ShippingBO
{
    public ShippingFactory $factory;

    public function __construct()
    {
        $this->factory = new ShippingFactory();
    }

    public function calculateShippingCartByCartId(int $id, string $destinationZipCode): array|string
    {
        $cartItensBO = new CartItemBO();
        $itens = $cartItensBO->findAllByCartId($id);
        if (!$itens) {
            throw new NotFoundException(FieldsEnum::ID);
        }
        $package = $this->generatePackageToCalcFromMultipleItens($itens);
        return $this->calculateShippingCorreios($package, $destinationZipCode);
    }

    public function generatePackageToCalcFromMultipleItens(array $itens): ShippingPackageDTO
    {
        $package = new ShippingPackageDTO();
        foreach ($itens as $item) {
            if ($item->stock->width > $package->getWidth()) {
                $package->setWidth($item->stock->width);
            }
            if ($item->stock->height > $package->getHeight()) {
                $package->setHeight($item->stock->height);
            }
            $package->setLength($package->getLength() + $item->stock->length);
            $package->setGrossWeight($package->getGrossWeight() + $item->stock->grossWeight);
        }
        return $package;
    }

    public function calculateShippingCorreios(ShippingPackageDTO $package, string $destinationZipCode): array
    {
        try {
            $correios = new ShippingCorreiosBO();
            $calculations = $correios->calculateShipping($package, $destinationZipCode);
            $packageCalculations = array();
            foreach ($calculations as $calculation) {
                $ShippingCalculated = $this->factory->getShippingCalculatedCorreios($package, $calculation);
                $packageCalculations[] = $ShippingCalculated;
            }
            return $packageCalculations;
        } catch (InvalidParamCalculateException $exception) {
            return array('Correios' => 'Parâmetros inválidos!');
        } catch (UnableToCalculateShipping $exception) {
            return array('Correios' => 'Correios não conseguiu fazer o cálculo!');
        }
    }

    public function calculateShippingCartByStockId(int $id, string $destinationZipCode): array
    {
        $itemBO = new ProductStockBO();
        $item = $itemBO->findById($id);
        if (!$item) {
            throw new NotFoundException(FieldsEnum::ID);
        }
        $package = $this->factory->factoryShippingPackageDtoFromItemStock($item);
        return $this->calculateShippingCorreios($package, $destinationZipCode);
    }
}