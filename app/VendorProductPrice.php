<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorProductPrice extends Model
{
    protected $fillable = [
        'vendor_id','product_id', 'old_price','new_price','discount','product_stock','remaining_stock','hot_deals','original_old_price','original_new_price','original_discount','hot_deals_expiry_date','vendor_product_status',
    ];
}
