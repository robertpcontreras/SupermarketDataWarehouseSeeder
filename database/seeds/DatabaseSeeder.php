<?php

use App\Date;
use App\PaymentMethod;
use App\Product;
use App\Promotion;
use App\Store;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        factory(App\Customer::class, 5000)->create();
//        factory(App\Cashier::class, 500)->create();
//
//        $places = fopen(storage_path('data/Towns_List.csv'), 'r');
//        
//        while(!feof($places))
//        {
//            $place = fgetcsv($places);
//            $regions[$place[1]][] = $place[0];
//        }
//
//        fclose($places);
//
//        foreach ($regions as $region => $towns) {
//            foreach ($towns as $town) {
//                Store::create([
//                    'StoreName' => $town . ' Store',
//                    'StoreRegion' => $region,
//                    'StoreTown' => $town,
//                    'StoreType' => 'Supermarket'
//                ]);
//            }
//        }
//
//        $begin = new DateTime( '2015-01-01' );
//        $end = new DateTime( '2016-05-01' );
//
//        $interval = DateInterval::createFromDateString('1 day');
//        $period = new DatePeriod($begin, $interval, $end);
//
//        foreach ($period as $dt) {
//            Date::Create([
//                'Date' => $dt->format("Y-m-d"),
//                'DayOfWeek' => $dt->format('l'),
//                'Month' => $dt->format('M'),
//                'YearlyQuarter' => ceil($dt->format('m')/3),
//                'Year' => $dt->format('Y'),
//            ]);
//        }
//
//        $paymentMethods = [
//            'Cash',
//            'Credit Card',
//            'Debit Card',
//            'Store Card',
//            'Multiple',
//            'Coupon'
//        ];
//
//        foreach ($paymentMethods as $paymentMethod) {
//            PaymentMethod::create(['MethodDescription' => $paymentMethod]);
//        }

//        $categories = collect(require(storage_path('data/category.php')));
//        $subCategories = collect(require(storage_path('data/subCategory.php')));
//
//        for ($i=0; $i < 40; $i++) {
//            $brands[] = 'Example Brand ' . $i;
//        }
//
//        $brands = collect($brands);
//
//        for ($i=0; $i < 5000; $i++) {
//            $category = $categories->random();
//            $subCategory = collect($subCategories[$category])->random();
//
//            Product::create([
//                'SKU' => mt_rand(1000, 9999) . '-' . mt_rand(10,99),
//                'ProductDescription' => 'Example Product ' . $i,
//                'Brand' => $brands->random(),
//                'Category' => $category,
//                'SubCategory' => $subCategory,
//                'Price' => number_format(30 / mt_rand(1,40),2)
//            ]);
//        }

//        $faker = Faker\Factory::create();
//
//        for ($i=0; $i < 10; $i++) {
//            Promotion::create([
//                'PromotionName' => 'Example Promotion ' . $i,
//                'PromotionDescription' => 'Promotion Description ' . $i,
//                'PromotionStartDate' => $faker->dateTimeBetween('-30 days')->format('Y-m-d'),
//                'PromotionEndDate' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d')
//            ]);
//        }


        $paymentMethods = [
            'Cash',
            'Credit Card',
            'Debit Card',
            'Store Card',
            'Multiple',
            'Coupon'
        ];

        $begin = new DateTime('2016-04-01');
        $end = new DateTime('2016-04-29');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $transactionNumber = 1000;
        foreach ($period as $dt) {
            $transactionNumber++;
            for ($i = 0; $i < 1000; $i++) {

                if (($transactionNumber % mt_rand(1,10)) == 0) {
                    $transactionNumber++;
                }

                $customer = \App\Customer::where('CustomerKey', (mt_rand(1, 10000)))->first();
                $cashier = \App\Cashier::where('CashierKey', (mt_rand(1, 1000)))->first();
                $product = \App\Product::where('ProductKey', (mt_rand(4, 5003)))->first();
                $date = \App\Date::where('Date', $dt->format('Y-m-d'))->first();
                $promotion = \App\Promotion::where('PromotionKey', (mt_rand(1,20)))->first();
                $paymentMethod = mt_rand(1,6);
                $store = \App\Store::where('StoreRegion', $customer->CustomerRegion)->get()->random();

                $quantity = mt_rand(1,5);
                $discount = 1 / mt_rand(2,10);

                Transaction::create([
                    'DateKey' => $date->DateKey,
                    'ProductKey' => $product->ProductKey,
                    'StoreKey' => $store->StoreKey,
                    'PromotionKey' => $promotion ? $promotion->PromotionKey : '',
                    'CashierKey' => $cashier->CashierKey,
                    'CustomerKey' => $customer->CustomerKey,
                    'PaymentMethodKey' => $paymentMethod,
                    'TransactionNumber' => $transactionNumber,
                    'QuantityPurchased' => $quantity,
                    'RegularItemPrice' => $product->Price,
                    'ItemDiscount' => $discount,
                    'NetPrice' => ($product->Price * (1-$discount)) * $quantity
                ]);
            }
        }
    }
}
