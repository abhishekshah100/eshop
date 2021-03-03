<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	// Order Status : 1 for on process, 2 for Delivered
    protected $fillable = [
        'invoice_number', 'customer_id', 'customer_name','customer_phone','payment_mode','delivery_date','discount','tax','total_invoice_amount','shipping_address','shipping_address_full_name','shipping_address_state','shipping_address_pincode','shipping_address_phone','billing_address_full_name','billing_address','billing_address_state','billing_address_pincode','billing_address_phone','order_description','order_status','coupon_id','coupon_code','discount_percentage','delivery_charges'
    ];

    public function productorder()
    {
        return $this->hasMany('App\ProductOrder');
    }
}
