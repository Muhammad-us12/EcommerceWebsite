<?php

namespace App\Actions;

use App\Models\ProductExtraPrice;

class CalculateCartTotalPrices
{
    public function __construct() {}

    /**
     * Delete the given user.
     */
    public function execute(array $cartData): array
    {
        $requestData = $cartData['request'];
        $dates = $this->getStartAndEndDate($requestData['bookingDates']);
        $extraPrices = [];
        $totalExtraPrice = 0;
        if (isset($requestData['selectedExtraPrices'])) {
            $extraPrices = $this->getExtraPrices($requestData['selectedExtraPrices']);

            foreach ($extraPrices as $extraPrice) {
                $totalExtraPrice += $extraPrice->value;
            }
        }

        $lineItems = $this->generateLineItems($cartData['products']);

        $subTotal = $totalExtraPrice + $product->security_deposit + $product->price;
        $discount = 0;
        $totalPrice = $subTotal - $discount;

        return [
            'startDate' => $dates['startDate'],
            'endDate' => $dates['endDate'],
            'cartLineItems' => [$product],
            'extraPrices' => $extraPrices,
            'goodFit' => $requestData['goodFit'],
            'adjustableIds' => $requestData['adjustableIds'],
            'adjustableValues' => $requestData['adjustableValues'],
            'securityDeposit' => $product->security_deposit,
            'totalExtraPrices' => $totalExtraPrice,
            'subTotal' => $subTotal,
            'discount' => 0,
            'totalPrice' => $totalPrice,
        ];
    }

    private function generateLineItems($cartProducts)
    {
        $lineItems = [];
        foreach ($cartProducts as $product) {
            $lineItems[] = [
                'product' => $product,
                'quantity' => 1,
                'price' => 
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

    private function getExtraPrices(array $extraPriceIds): array
    {
        $extraPrices = [];
        foreach ($extraPriceIds as $extraPrice) {
            $productExtraPrice = ProductExtraPrice::find($extraPrice);
            $extraPrices[] = $productExtraPrice;
        }

        return $extraPrices;
    }
}
