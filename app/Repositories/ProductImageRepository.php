<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use App\Interfaces\ProductImageRepositoryInterface;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    public function addImages(Product $product, array $images)
    {
        foreach ($images as $image) {
            if (isset($image['image']) && $image['image'] instanceof UploadedFile) {
                $path = $image['image']->store('product-images', 'public');

                $product->productImages()->create([
                    'image_path' => $path,
                    'is_primary' => $image['is_primary'] ?? false,
                    'sort_order' => $image['sort_order'] ?? 0
                ]);
            }
        }

        return $product->productImages;
    }
}
