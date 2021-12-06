<?php

namespace App\Machine;

/**
 * Interface PurchasedItemInterface
 * @package App\Machine
 */
interface PurchasedItemInterface
{

    public function getTotalPrice(): float;

    public function getChange(): float;
}