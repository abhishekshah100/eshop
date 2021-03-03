<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $fillable = [
        'pincode','delivery_status','delivery_in_days','minimum_order','delivery_charges','pincode_status',
    ];
}
