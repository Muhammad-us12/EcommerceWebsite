<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\VendorEarnSalePercentage;
use App\Models\VendorSalePercentage;

class MakeOrderAsComplete
{
    public function execute(Order $order)
    {
        $this->calculateVendorSalePercentage($order);
        $this->releaseCustomerSecurityDeposit($order);

    }

    private function releaseCustomerSecurityDeposit(Order $order)
    {

        $partyData = [
            'partyId' => $order->customer->party->id,
            'amount' => $order->lineItem->security_deposit,
            'incrementType' => 'decrement',
            'dbFeildId' => 'order_id',
            'dbFeild' => 'payment',
            'orderId' => $order->id,
            'remarks' => 'Security Deposit Released',
            'date' => now(),
        ];

        $this->updateCustomerBalance($partyData);
    }

    private function updateCustomerBalance(array $partyData)
    {
        // Update Party Balance
        $updatePartyBalance = app(UpdatePartyBalance::class);
        $updatePartyBalance->execute($partyData['partyId'], $partyData['amount'], $partyData['incrementType']);

        // Insert Party Ledger
        $SavePartyLedger = app(SavePartyLedger::class);
        $SavePartyLedger->execute($partyData['partyId'], $partyData['amount'], $partyData['dbFeildId'], $partyData['dbFeild'], $partyData['orderId'], $partyData['remarks'], date: $partyData['date']);
    }

    private function calculateVendorSalePercentage(Order $order)
    {

        $vendorSalePercentage = VendorSalePercentage::where('status', 'active')->first();
        $percentage = $vendorSalePercentage->percentage;
        $saleAmounts = [];

        foreach ($order->lineItems as $lineItem) {
            $product = $lineItem->product;
            $user = $product->user; // Assuming the product has a user relationship for the vendor
            $vendor = $user->vendor;
            $salePercentAmount = ($lineItem->price_for_total_days * $percentage) / 100;

            VendorEarnSalePercentage::create([
                'receivable_amount' => $salePercentAmount,
                'vendor_id' => $vendor->id,
                'sale_percentage_id' => $vendorSalePercentage->id,
                'order_id' => $order->id,
            ]);

            $partyData = [
                'partyId' => $vendor->party->id,
                'amount' => $salePercentAmount,
                'incrementType' => 'decrement',
                'dbFeildId' => 'order_id',
                'dbFeild' => 'payment',
                'orderId' => $order->id,
                'remarks' => 'New Order Placed',
                'date' => now(),
            ];

            $this->updateVendorBalance($partyData);
        }

    }

    private function updateVendorBalance(array $partyData)
    {
        // Update Party Balance
        $updatePartyBalance = app(UpdatePartyBalance::class);
        $updatePartyBalance->execute($partyData['partyId'], $partyData['amount'], $partyData['incrementType']);

        // Insert Party Ledger
        $SavePartyLedger = app(SavePartyLedger::class);
        $SavePartyLedger->execute($partyData['partyId'], $partyData['amount'], $partyData['dbFeildId'], $partyData['dbFeild'], $partyData['orderId'], $partyData['remarks'], date: $partyData['date']);
    }
}
