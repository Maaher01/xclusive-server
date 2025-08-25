<?php

namespace App\Interfaces;

use App\Models\ProductImage;

interface ProductImageRepositoryInterface
{
    public function addImages(array $data);
}
