<?php

use Illuminate\Database\Seeder;

class Transactions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            'Cash',
            'Credit Card',
            'Debit Card',
            'Store Card',
            'Multiple',
            'Coupon'
        ];

        $begin = new DateTime('2016-04-01');
        $end = new DateTime('2016-04-30');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        foreach ($period as $dt) {
            for ($i = 0; $i < 1000; $i++) {
                $customer = \App\Customer::find(mt_rand(0, 99999));
                $cashier = \App\Cashier::find(mt_rand(0, 999));
                $product = \App\Product::find(mt_rand(0, 9999));
                $date = \App\Date::where('Date', $dt->format('Y-m-d'));
                $promotion = \App\Promotion::find(mt_rand(19));
                $paymentMethod = $paymentMethods[mt_rand(0,5)];
                $store = \App\Store::where('StoreRegion', $customer->CustomerRegion)->random();

                $quantity = mt_rand(1,5);
                $discount = 1 / mt_rand(2,10);

                \App\Transaction::create([
                    'DateKey' => $date->DateKey,
                    'ProductKey' => $product->ProductKey,
                    'StoreKey' => $store->StoreKey,
                    'PromotionKey' => $promotion->PromotionKey,
                    'CashierKey' => $cashier->CashierKey,
                    'CustomerKey' => $customer->CustomerKey,
                    'PaymentMethodKey' => $paymentMethod->PaymentMethodKey,
                    'TransactionNumber' => mt_rand(10000,99999),
                    'QuantityPurchased' => $quantity,
                    'RegularItemPrice' => $product->Price,
                    'ItemDiscount' => $discount,
                    'NetPrice' => ($product->Price * $discount) * $quantity
                ]);
            }
        }
    }
}
