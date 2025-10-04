<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartResource;
use App\Interfaces\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartRepo;

    public function __construct(CartRepositoryInterface $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCart = $this->cartRepo->getUserCart();

        if (!$userCart) {
            return response()->json(['message' => 'Your cart is empty'], 200);
        }

        return response()->json(['data' => new CartResource($userCart)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartItemRequest $request)
    {
        $this->authorize('create', CartItem::class);

        $cartItem = $this->cartRepo->addProductToCart($request->validated());

        return response()->json(['status' => true, 'data' => $cartItem]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);

        $deletedItem = $this->cartRepo->removeProductFromCart($cartItem);

        return response()->json([
            'message' => $deletedItem ? 'Item removed from cart' : 'Failed to remove item from cart',
            'status' => $deletedItem
        ], $deletedItem ? 200 : 400);
    }
}
