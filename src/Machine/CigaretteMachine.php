<?php

namespace App\Machine;

use App\Machine\Dto\DtoOutput;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    public const ITEM_PRICE = 4.99;

    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface
    {
        $totalPrice = $purchaseTransaction->getItemQuantity() * self::ITEM_PRICE;

        if ($purchaseTransaction->getPaidAmount() < $totalPrice) {
            throw new NotEnoughMoneyException();
        }
        $change = $totalPrice - $purchaseTransaction->getPaidAmount();


        return new DtoOutput($totalPrice, $change);
    }
}