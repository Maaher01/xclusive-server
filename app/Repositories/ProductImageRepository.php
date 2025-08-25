<?php

namespace App\Repositories;

use App\Interfaces\ProductImageRepositoryInterface;
use App\Models\ProductImage;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    public function addImages(array $data)
    {
        return ProductImage::create($data);
    }
}
