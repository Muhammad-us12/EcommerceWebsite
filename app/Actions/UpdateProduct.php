<?php

namespace App\Actions;

use App\Http\Requests\ProductUpdateValidation;
use App\Models\Product;
use App\Models\ProductAssignedAttributes;
use App\Models\ProductExtraPrice;

class UpdateProduct
{
    public function __construct() {}

    /**
     * Update the given product.
     */
    public function execute(Product $product, array $validatedRequest, ProductUpdateValidation $requestData): Product
    {
        if (isset($validatedRequest['display_on_website'])) {

            $validatedRequest['display_on_website'] = (bool) $validatedRequest['display_on_website'];
        }
        $product->update($validatedRequest);

        if ($product) {
            if ($requestData->hasFile('thumbnail')) {
                $product->clearMediaCollection('image');
                $product->addMediaFromRequest('thumbnail')->toMediaCollection('image');
            }
        }

        // Get existing attributes and extra prices
        $existingAttributes = $product->productAssignedAttributes->pluck('attribute_id')->toArray();
        $existingExtraPrices = $product->productExtraPrices->pluck('price_id')->toArray();

        // Update product attributes
        $newAttributes = [];

        if (isset($requestData->attributesId)) {
            foreach ($requestData->attributesId as $index => $attributeId) {
                if ($requestData['attributes'][$index]) {
                    ProductAssignedAttributes::updateOrCreate(
                        [
                            'attribute_id' => $attributeId,
                            'product_id' => $product->id,
                        ],
                        [
                            'attribute_id' => $attributeId,
                            'value' => $requestData['attributes'][$index],
                            'product_id' => $product->id,
                            'adjustable' => (bool) $requestData['adjustable'][$index],
                            'min_value' => $requestData['min_value'][$index],
                            'max_value' => $requestData['max_value'][$index],
                        ]
                    );
                    $newAttributes[] = $attributeId;
                }
            }
        }

        // Delete removed attributes
        $attributesToDelete = array_diff($existingAttributes, $newAttributes);
        ProductAssignedAttributes::whereIn('attribute_id', $attributesToDelete)
            ->where('product_id', $product->id)
            ->delete();

        // Update extra prices
        $newExtraPrices = [];
        if (isset($requestData->price_ids)) {
            foreach ($requestData->price_ids as $index => $priceId) {
                if ($requestData['price_values'][$index]) {
                    ProductExtraPrice::updateOrCreate(
                        [
                            'price_id' => $priceId,
                            'product_id' => $product->id,
                        ],
                        [
                            'price_id' => $priceId,
                            'value' => $requestData['price_values'][$index],
                            'product_id' => $product->id,
                        ]
                    );
                    $newExtraPrices[] = $priceId;
                }
            }
        }

        // Delete removed extra prices
        $extraPricesToDelete = array_diff($existingExtraPrices, $newExtraPrices);
        ProductExtraPrice::whereIn('price_id', $extraPricesToDelete)
            ->where('product_id', $product->id)
            ->delete();

        return $product;
    }
}
