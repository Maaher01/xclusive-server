<?php

namespace App\Repositories;

use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function all()
    {
        return SubCategory::query();
    }

    public function create(array $data)
    {
        return SubCategory::create($data);
    }

    public function update(SubCategory $sub_category, array $data)
    {
        $sub_category->update($data);
        return $sub_category;
    }

    public function delete(SubCategory $sub_category)
    {
        return $sub_category->delete();
    }

    public function getByCategory(Category $category)
    {
        return $category->subCategory;
    }
}
