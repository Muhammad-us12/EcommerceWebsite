<?php

namespace App\Http\Requests;

use App\Enums\ProductSize;
use App\Enums\Status;
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
        $productSizes = implode(',', array_column(ProductSize::cases(), 'value'));
        $productStatus = implode(',', array_column(Status::cases(), 'value'));

        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id' => ['required', 'integer', 'exists:categories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'price' => ['required', 'numeric'],
            'security_deposit' => ['required', 'numeric'],
            'thumbnail' => ['nullable', 'mimes:jpeg,jpg,png,gif|max:10244'],
            'user_id' => ['nullable', 'string', 'exists:users,id'],
            'cost_price' => ['required', 'numeric'],
            'attributes.*' => ['nullable'],
            'attributesId.*' => ['nullable', 'exists:product_attributes,id'],
            'size' => ['required', 'string', 'in:'.$productSizes.''],
            'status' => ['required', 'string', 'in:'.$productStatus.''],
            'rent_for_days' => ['required', 'integer', 'min:1'],
            'review_remarks' => ['nullable', 'string'],
            'display_on_website' => ['string', 'in:true,false'],
            'adjustable.*' => ['string', 'in:true,false'],
            'min_value.*' => ['nullable', 'numeric'],
            'max_value.*' => ['nullable', 'numeric'],
            'price_ids.*' => ['nullable', 'exists:extra_prices,id'],
            'price_values.*' => ['nullable', 'numeric'],
        ];
    }
}
