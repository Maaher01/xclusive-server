<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductImageRepositoryInterface
{
    public function addImages(Product $product, array $images);
}
