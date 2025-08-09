<?php

namespace App\Services;

class DiscountService
{
    public function calculateDiscount($price, $percentage)
    {
        return $price - ($price * $percentage / 100);
    }
}
