<?php

namespace App\Http\Requests;

use App\Enums\ProductSize;
use Illuminate\Foundation\Http\FormRequest;

class ProductValidation extends FormRequest
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
        $productSizes = implode(',', array_column(ProductSize::cases(), 'value'));

        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'size' => ['required', 'string', 'in:'.$productSizes.''],
            'subcategory_id' => ['required', 'integer', 'exists:categories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'price' => ['required', 'numeric'],
            'rent_for_days' => ['required', 'integer', 'min:1'],
            'cost_price' => ['required', 'numeric'],
            'security_deposit' => ['required', 'numeric'],
            'user_id' => ['nullable', 'string', 'exists:users,id'],
            'thumbnail' => ['required', 'mimes:jpeg,jpg,png,gif|max:10244'],
            'attributes.*' => ['nullable'],
            'attributesId.*' => ['nullable', 'exists:product_attributes,id'],
            'adjustable.*' => ['string', 'in:true,false'],
            'min_value.*' => ['nullable', 'numeric'],
            'max_value.*' => ['nullable', 'numeric'],
            'price_ids.*' => ['nullable', 'exists:extra_prices,id'],
            'price_values.*' => ['nullable', 'numeric'],
        ];
    }
}
