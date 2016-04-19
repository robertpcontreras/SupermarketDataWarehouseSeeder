<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $timestamps = false;
    
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
