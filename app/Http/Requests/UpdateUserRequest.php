<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'fullname' => 'required|string|min:3|max:100',
            'role' => 'required',
            'address' => 'required|string|min:5',
            'phoneNumber' => 'required|string|min:8|max:13',
            'email' => 'required|email:dns|min:5',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:1024'
        ];
    }
}
