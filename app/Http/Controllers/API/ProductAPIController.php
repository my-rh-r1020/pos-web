<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductAPIController extends BaseResponseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse($products, 'All products successful loaded');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->product_name);

        if ($data) {
            if ($productImg = $request->file('product_img')) {
                $imageName = date('YmdHis') . "." . $productImg->getClientOriginalExtension();
                $productImg->storeAs('product-image', $imageName);
                $data['product_img'] = $imageName;
            }

            $product = Product::create($data);
            return $this->sendResponse($product, 'New product successful added');
        }

        return $this->sendError('Error', ['failed', 'Create product failed']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Product check
        if (!$product) return $this->sendError('Product not found');
        return $this->sendResponse($product, 'Product was found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->product_name);

        if ($data) {
            if ($productImg = $request->file('product_img')) {
                $imageName = date('YmdHis') . "." . $productImg->getClientOriginalExtension();
                $productImg->storeAs('product-image', $imageName);
                $data['product_img'] = $imageName;
            } else {
                unset($data['product_img']);
            }

            $product->update($data);
            return $this->sendResponse($product, 'Product successful updated');
        }

        return $this->sendError('Error', ['failed', 'Update product failed']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Storage::exists('public/product-image/' . $product->product_img)) {
            Storage::delete('public/product-image/' . $product->product_img);
        }

        $product->deleteOrFail();
        return $this->sendResponse([], 'Product successful deleted');
    }
}
