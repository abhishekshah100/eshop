<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productstock extends Model
{
    protected $fillable = [
        'product_id','quantity',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }
}
