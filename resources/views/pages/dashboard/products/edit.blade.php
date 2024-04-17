@extends('layout.dashboard.main')

@section('title','Update Product')

@section('mainContent')
<div class="mb-8 text-grayText">
    <h3 class="content-title">Edit Product</h3>
</div>
<div class="bg-[#fff] rounded-md p-4">
    <form action="{{ route('products.update',$product->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <div class="relative mb-5">
                    <input type="text" id="floating_name" name="product_name" value="{{ old('product_name',$product->product_name) }}" class="form-input border-1 peer" placeholder=" " />
                    <label for="floating_name" class="form-label">Product Name</label>
                    @error('product_name')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>Choose category</option>
                        @foreach ($categories as $category)
                        @if (old('category_id',$product->category_id) == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="relative mb-5">
                    <textarea rows="3" name="description" id="floating_description" value="{{ old('description') }}" class="form-input border-1 peer" placeholder=" ">{{ $product->description }}</textarea>
                    <label for="floating_description" class="absolute text-base text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Descriptions</label>
                    @error('description')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative mb-5">
                    <input type="number" id="floating_stock" name="stock" value="{{ old('stock',$product->stock) }}" class="form-input border-1 peer" placeholder=" " />
                    <label for="floating_stock" class="form-label">Stock</label>
                    @error('stock')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative mb-5">
                    <input type="number" id="floating_price" name="price" value="{{ old('price',$product->price) }}" class="form-input border-1 peer" placeholder=" " />
                    <label for="floating_price" class="form-label">Price</label>
                    @error('price')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <label class="block mb-2 text-base font-medium text-gray-900">Preview</label>
                <img src="{{ asset('storage/product-image/'.$product->product_img) }}" alt="preview" class="mb-4 border" width="200px" height="200px">

                <label class="block mb-2 text-base font-medium text-gray-900">Upload Product Image</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG(MAX. 1MB)</p>
                        </div>
                        <input id="dropzone-file" name="product_img" type="file" class="hidden" />
                    </label>
                </div>
                @error('product_img')
                <p class="error-form-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="mt-4 md:mt-0 submit-btn">Update</button>
        </div>
    </form>
</div>
@endsection
