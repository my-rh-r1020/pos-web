<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|min:3',
            'category_id' => 'required',
            'description' => 'required|min:5',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'product_img' => 'image|mimes:jpeg,png,jpg|max:1024'
        ];
    }
}
