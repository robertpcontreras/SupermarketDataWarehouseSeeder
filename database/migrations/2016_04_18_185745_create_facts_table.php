<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('DateKey')->unsigned();
            $table->integer('ProductKey')->unsigned();
            $table->integer('StoreKey')->unsigned();
            $table->integer('PromotionKey')->unsigned();
            $table->integer('CashierKey')->unsigned();
            $table->integer('CustomerKey')->unsigned();
            $table->integer('PaymentMethodKey')->unsigned();
            $table->integer('TransactionNumber')->unsigned();
            $table->integer('QuantityPurchased')->unsigned();
            $table->decimal('RegularItemPrice')->unsigned();
            $table->decimal('ItemDiscount')->unsigned();
            $table->decimal('NetPrice')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
