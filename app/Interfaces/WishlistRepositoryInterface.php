<?php

namespace App\Interfaces;

use App\Models\Wishlist;

interface WishlistRepositoryInterface
{
    public function addProductToWishlist(array $data);
    public function deleteProductFromWishlist(Wishlist $wishlist);
}
