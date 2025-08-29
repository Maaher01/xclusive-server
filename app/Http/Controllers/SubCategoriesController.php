<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    protected $subCategoryRepo;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepo)
    {
        $this->subCategoryRepo = $subCategoryRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = $this->subCategoryRepo->all()->select('id', 'name', 'image')->get();

        return response()->json(['data' => SubCategoryResource::collection($subCategories), 'status' => true], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $this->authorize('create', SubCategory::class);

        $subCategoryData = $request->validated();

        if ($request->hasFile('image')) {
            $subCategoryData['image'] = $request->file('image')->store('sub-category-images', 'public');
        }

        $subCategory = $this->subCategoryRepo->create($subCategoryData);

        return response()->json(['data' => $subCategory, 'status' => true], 200);
    }

    public function getByCategory(Category $category)
    {
        $subCategories = $this->subCategoryRepo->getByCategory($category);

        return response()->json(['data' => $subCategories, 'status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
