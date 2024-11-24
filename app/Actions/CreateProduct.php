<?php

namespace App\Actions;

use App\Http\Requests\ProductValidation;
use App\Models\Product;
use App\Models\ProductAssignedAttributes;

class CreateProduct
{
    public function __construct() {}

    /**
     * Delete the given user.
     */
    public function execute(array $validatedRequest, ProductValidation $requestData): Product
    {
        // dd($requestData->toArray());
        $product = Product::create($validatedRequest);

        if ($product) {
            if ($requestData->hasFile('thumbnail')) {
                $product->addMediaFromRequest('thumbnail')->toMediaCollection('image');
            }
        }

        foreach ($requestData->attributesId as $index => $attributeId) {
            if (! $requestData['attributes'][$index]) {
                continue;
            }

            ProductAssignedAttributes::create([
                'attribute_id' => $attributeId,
                'value' => $requestData['attributes'][$index],
                'product_id' => $product->id,
            ]);
        }

        return $product;

    }
}
