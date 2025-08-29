<?php

namespace App\Interfaces;

use App\Models\SubCategory;
use App\Models\Category;

interface SubCategoryRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(SubCategory $sub_category, array $data);
    public function delete(SubCategory $sub_category);
    public function getByCategory(Category $category);
}
