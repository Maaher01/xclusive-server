<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Http\Requests\WishlistRequest;
use App\Interfaces\WishlistRepositoryInterface;

class WishlistController extends Controller
{
    protected $wishlistRepo;

    public function __construct(WishlistRepositoryInterface $wishlistRepo)
    {
        $this->wishlistRepo = $wishlistRepo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WishlistRequest $request)
    {
        $this->authorize('create', Wishlist::class);

        $wishlistItem = $this->wishlistRepo->addProductToWishlist($request->validated());

        return response()->json(['data' => $wishlistItem, 'status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->with('product.productImages')
            ->get();

        $wishlist->each(function ($item) {
            $item->product->images = $item->product->productImages;
            unset($item->product->productImages);
        });


        $itemCount = $wishlist->count();

        return response()->json([
            'data' => $wishlist,
            'itemCount' => $itemCount,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        $this->authorize('delete', $wishlist);

        $deleted = $this->wishlistRepo->deleteProductFromWishlist($wishlist);

        return response()->json([
            'message' => $deleted ? 'Removed from wishlist' : 'Failed to remove',
            'status' => $deleted
        ], $deleted ? 200 : 400);
    }
}
