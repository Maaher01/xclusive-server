<?php

namespace App\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(Category $category, array $data);
    public function delete(Category $category);
}
