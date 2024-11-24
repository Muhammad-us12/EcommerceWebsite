<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateValidation extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id' => ['required', 'integer', 'exists:categories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'security_deposit' => ['required', 'numeric'],
            'thumbnail' => ['nullable', 'mimes:jpeg,jpg,png,gif|max:10244'],
            'user_id' => ['nullable', 'string', 'exists:users,id'],
            'cost_price' => ['required', 'numeric'],
            'attributes.*' => ['nullable'],
            'attributesId.*' => ['nullable', 'exists:product_attributes,id'],
        ];
    }
}
