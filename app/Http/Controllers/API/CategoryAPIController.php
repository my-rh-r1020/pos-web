<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

class CategoryAPIController extends BaseResponseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return $this->sendResponse($categories, 'All categories successful loaded');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);

        $category = Category::create($data);
        return $this->sendResponse($category, 'New category successful added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Category check
        if (!$category) return $this->sendError('Category not found!');
        return $this->sendResponse($category, 'Category was found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);

        $category->update($data);
        return $this->sendResponse($category, 'Category successful updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->deleteOrFail();
        return $this->sendResponse([], 'Category successful deleted');
    }
}
