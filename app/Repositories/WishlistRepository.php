<?php

namespace App\Repositories;

use App\Interfaces\WishlistRepositoryInterface;
use App\Models\Wishlist;

class WishlistRepository implements WishlistRepositoryInterface
{
    public function addProductToWishlist(array $data)
    {
        $data['user_id'] = auth()->id();
        return Wishlist::create($data);
    }

    public function deleteProductFromWishlist(Wishlist $wishlist)
    {
        return $wishlist->delete();
    }
}
