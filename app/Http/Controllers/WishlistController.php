<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Interfaces\WishlistRepositoryInterface;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    protected $wishlistRepo;

    public function __construct(WishlistRepositoryInterface $wishlistRepo)
    {
        $this->wishlistRepo = $wishlistRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $wishlist = Wishlist::where('user_id', auth()->id())->with('product.productImages')->get();

        $itemCount = $wishlist->count();

        return response()->json(['data' => $wishlist, 'itemCount' => $itemCount]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
