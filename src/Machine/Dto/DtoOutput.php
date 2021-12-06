<?php

namespace App\Machine\Dto;

use App\Machine\PurchasedItemInterface;

class DtoOutput implements PurchasedItemInterface
{
    private float $totalPrice;

    private float $change;

    public function __construct(float $totalPrice, float $change)
    {
        $this->totalPrice = $totalPrice;
        $this->change = $change;
    }

    public function getChange(): float
    {
        return $this->change;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
}