<?php

namespace App\Actions;

use App\Http\Requests\ProductValidation;
use App\Models\Product;
use App\Models\ProductAssignedAttributes;
use App\Models\ProductExtraPrice;
use Illuminate\Support\Facades\DB;

class CreateProduct
{
    public function __construct() {}

    /**
     * Delete the given user.
     */
    public function execute(array $validatedRequest, ProductValidation $requestData, string $productStatus): Product
    {
        return DB::transaction(function () use ($validatedRequest, $requestData, $productStatus) {
            $validatedRequest['status'] = $productStatus;
            $product = Product::create($validatedRequest);

            if ($product) {
                if ($requestData->hasFile('thumbnail')) {
                    $product->addMediaFromRequest('thumbnail')->toMediaCollection('image');
                }
            }

            if (isset($requestData->attributesId)) {
                foreach ($requestData->attributesId as $index => $attributeId) {
                    if (! $requestData['attributes'][$index]) {
                        continue;
                    }

                    ProductAssignedAttributes::create([
                        'attribute_id' => $attributeId,
                        'value' => $requestData['attributes'][$index],
                        'adjustable' => (bool) $requestData['adjustable'][$index],
                        'min_value' => $requestData['min_value'][$index],
                        'max_value' => $requestData['max_value'][$index],
                        'product_id' => $product->id,
                    ]);
                }
            }

            if (isset($requestData->price_ids)) {
                foreach ($requestData->price_ids as $index => $priceId) {
                    if (! $requestData['price_values'][$index]) {
                        continue;
                    }

                    ProductExtraPrice::create([
                        'price_id' => $priceId,
                        'value' => $requestData['price_values'][$index],
                        'product_id' => $product->id,
                    ]);
                }
            }

            return $product;
        });

    }
}
