<?php

namespace App\Machine\Dto;

use App\Machine\PurchaseTransactionInterface;

class DtoInput implements PurchaseTransactionInterface
{
    private int $itemQuantity;

    private float $paidAmount;

    public function __construct(int $itemQuantity, float $paidAmount)
    {
        $this->itemQuantity = $itemQuantity;
        $this->paidAmount = $paidAmount;
    }

    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }
}