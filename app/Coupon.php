<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'discount_percentage','discount_amount_upto','coupon_code','starting_date','ending_date','minimum_amount','coupon_status','use_per_customer'
    ];

    public function setCouponCodeAttribute($value)
	{
	        $this->attributes['coupon_code'] = strtoupper($value);
	}
}
