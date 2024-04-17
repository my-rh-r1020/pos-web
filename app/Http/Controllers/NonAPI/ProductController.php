<?php

namespace App\Http\Controllers\NonAPI;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $products = Product::when(
                $request->input('search'),
                fn ($query, $search) => $query->where('product_name', 'like', '%' . $search . '%')
            )->orderBy('id', 'desc')->paginate(10);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);
        }

        return view('pages.dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->product_name);

            if ($productImg = $request->file('product_img')) {
                $imageName = date('YmdHis') . "." . $productImg->getClientOriginalExtension();
                $productImg->storeAs('product-image', $imageName);
                $data['product_img'] = $imageName;
            }

            Product::create($data);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);
        }

        return redirect()->route('products.index')->with('success', 'New product successful added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('pages.dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->product_name);

            if ($productImg = $request->file('product_img')) {
                $imageName = date('YmdHis') . "." . $productImg->getClientOriginalExtension();
                $productImg->storeAs('product-image', $imageName);
                $data['product_img'] = $imageName;
            } else {
                unset($data['product_img']);
            }

            $product->update($data);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);
        }

        return redirect()->route('products.index')->with('success', 'Product successful updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $productImgPath = Storage::path($product->product_img);

            if ($product->product_img && $productImgPath) {
                Storage::delete($productImgPath);
            }

            $product->deleteOrFail();
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);
        }

        return redirect()->route('products.index')->with('success', 'Product successful deleted');
    }
}
