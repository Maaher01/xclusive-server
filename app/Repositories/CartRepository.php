<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\CartItem;

class CartRepository implements CartRepositoryInterface
{
    public function getUserCart()
    {
        return Cart::with('cartItems.product.productImages')->where('user_id', auth()->id())->first();
    }

    public function addProductToCart(array $data)
    {
        $userId = auth()->id();

        $cart = Cart::firstOrCreate(
            ['user_id' => $userId]
        );

        $cartItem = $cart->cartItems()->where('product_id', $data['product_id'])->first();

        if ($cartItem) {
            $cartItem->quantity += $data['quantity'] ?? 1;
            $cartItem->save();
        } else {
            $cart->cartItems()->create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'] ?? 1,
                'unit_price' => $data['unit_price'] ?? 0,
            ]);
        }

        return $cart->load('cartItems');
    }

    public function removeProductFromCart(CartItem $cartItem)
    {
        return $cartItem->delete();
    }
}
