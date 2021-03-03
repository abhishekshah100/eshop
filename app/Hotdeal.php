<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotdeal extends Model
{
    protected $fillable = [
        'product_id','hot_deals_old_price','hot_deals_new_price','hot_deals_discount','hot_deals_expiry_date',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }
}
