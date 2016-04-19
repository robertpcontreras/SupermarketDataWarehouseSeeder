<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDimensionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->increments('DateKey');
            $table->string('Date');
            $table->string('DayOfWeek');
            $table->string('Month');
            $table->string('YearlyQuarter');
            $table->string('Year');
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('ProductKey');
            $table->string('SKU');
            $table->string('ProductDescription');
            $table->string('Brand');
            $table->string('Category');
            $table->string('SubCategory');
            $table->decimal('Price');
        });
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('StoreKey');
            $table->string('StoreName');
            $table->string('StoreRegion');
            $table->string('StoreTown');
            $table->string('StoreType');
        });
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('PromotionKey');
            $table->string('PromotionName');
            $table->string('PromotionDescription');
            $table->string('PromotionStartDate');
            $table->string('PromotionEndDate');
        });
        Schema::create('cashiers', function (Blueprint $table) {
            $table->increments('CashierKey');
            $table->string('EmployeeID');
            $table->string('CashierName');
            $table->integer('CashierAge');
            $table->string('CashierGender');
            $table->string('EmploymentStartDate');
        });
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('CustomerKey');
            $table->string('CustomerName');
            $table->string('CustomerGender');
            $table->string('CustomerAge');
            $table->string('CustomerRegion');
            $table->string('CustomerTown');
            $table->string('MemberBeginDate');
        });
        Schema::create('paymentMethods', function (Blueprint $table) {
            $table->increments('PaymentMethodKey');
            $table->string('MethodDescription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dates');
        Schema::drop('products');
        Schema::drop('stores');
        Schema::drop('promotions');
        Schema::drop('cashiers');
        Schema::drop('customers');
        Schema::drop('paymentMethods');
    }
}
