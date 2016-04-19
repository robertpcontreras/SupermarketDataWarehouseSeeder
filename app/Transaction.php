<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function cashier()
    {
        return $this->hasOne(Cashier::class);
    }

    public function promotion()
    {
        return $this->hasOne(Promotion::class);
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class);
    }

    public function date()
    {
        return $this->hasOne(Date::class);
    }
}
