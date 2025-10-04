<?php

namespace App\Interfaces;

use App\Models\CartItem;

interface CartRepositoryInterface
{
    public function getUserCart();
    public function addProductToCart(array $data);
    public function removeProductFromCart(CartItem $cartItem);
}
