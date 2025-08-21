<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Cache::remember('products', 600, function () {
            $products = $this->productRepo->all()->select('id', 'name', 'price', 'discount_amount')->get();
            return ProductResource::collection($products);
        });

        return response()->json(['status' => true, 'data' => $products], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);

        $product = $this->productRepo->create($request->validated());
        Cache::forget('products');

        return response()->json(['status' => true, 'data' => $product], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);

        return response()->json(['status' => true, 'data' => $product], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $updatedProduct = $this->productRepo->update($product, $request->validated());

        return response()->json(['status' => true, 'data' => $updatedProduct], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $this->productRepo->delete($product);

        return response()->json(['status' => true, 'message' => 'Product deleted successfully']);
    }
}
