<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $fillable = [
        'order_id','product_id','product_name','final_price','feature_image','product_quantity',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
