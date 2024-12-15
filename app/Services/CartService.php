<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductExtraPrice;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CartService
{
    protected array $items; // To hold cart items.

    public function __construct()
    {
        // $this->items = collect(); // Initialize cart items collection.
    }

    /**
     * Add an item to the cart.
     */
    public function addItem(Product $product, string $bookingDates, ?array $extraServicesId, ?bool $goodFit, ?array $adjustableIds, ?array $adjustableValues): array
    {
        if ($product) {

            $extraServicesCollection = [];
            $extraServiceTotal = 0;
            if (! empty($extraServicesId)) {
                $extraServicesModels = $this->getExtraServices($extraServicesId);
                $extraServicesCollection = collect($extraServicesModels);

                $extraServiceTotal = $extraServicesCollection->sum(function ($extraService) {
                    return $extraService['value'];
                });
            }

            $dates = $this->getStartAndEndDate($bookingDates);

            $startDate = Carbon::parse($dates['startDate']);
            $endDate = Carbon::parse($dates['endDate']);

            // Get the difference in days
            $daysDifference = $startDate->diffInDays($endDate);

            $discount = 0;
            $priceForTotalDays = $product->price * $daysDifference;
            $subTotalPrice = $priceForTotalDays + $extraServiceTotal + $product->security_deposit;
            $totalPrice = $subTotalPrice - $discount;

            return $this->items = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
                'extraService' => $extraServicesCollection,
                'product' => $product,
                'price' => $product->price,
                'priceForTotalDays' => $priceForTotalDays,
                'securityDeposit' => $product->security_deposit,
                'subTotalPrice' => $subTotalPrice,
                'extraServiceTotal' => $extraServiceTotal,
                'discount' => $discount,
                'totalPrice' => $totalPrice,
                'totalPrice' => $totalPrice,
                'adjustableIds' => $adjustableIds,
                'adjustableValues' => $adjustableValues,
                'goodFit' => $goodFit,
                'startDate' => $dates['startDate'],
                'endDate' => $dates['endDate'],
                'totalDays' => $daysDifference,
            ];
        }
    }

    private function getStartAndEndDate(string $dateString)
    {
        [$startDate, $endDate] = explode(' to ', $dateString);

        $startDate = trim($startDate);
        $endDate = trim($endDate);

        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];
    }

    private function getExtraServices(array $extraServiceIds): array
    {
        $extraPrices = [];
        foreach ($extraServiceIds as $extraPrice) {
            $productExtraPrice = ProductExtraPrice::find($extraPrice);
            $extraPrices[] = $productExtraPrice;
        }

        return $extraPrices;
    }
}
