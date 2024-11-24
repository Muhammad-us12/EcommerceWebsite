<?php

namespace App\Actions;

use App\Http\Requests\ProductUpdateValidation;
use App\Models\Product;
use App\Models\ProductAssignedAttributes;

class UpdateProduct
{
    public function __construct() {}

    /**
     * Delete the given user.
     */
    public function execute(Product $product, array $validatedRequest, ProductUpdateValidation $requestData): Product
    {
        $product->update($validatedRequest);

        if ($product) {
            if ($requestData->hasFile('thumbnail')) {
                $product->clearMediaCollection('image');
                $product->addMediaFromRequest('thumbnail')->toMediaCollection('image');
            }
        }

        foreach ($requestData->attributesId as $index => $attributeId) {
            if (! $requestData['attributes'][$index]) {
                ProductAssignedAttributes::where('attribute_id', $attributeId)
                    ->where('product_id', $product->id)
                    ->delete();

                continue;
            }

            ProductAssignedAttributes::updateOrCreate(
                [
                    'attribute_id' => $attributeId,
                    'product_id' => $product->id,
                ],
                [
                    'attribute_id' => $attributeId,
                    'value' => $requestData['attributes'][$index],
                    'product_id' => $product->id,
                ]);
        }

        return $product;

    }
}
