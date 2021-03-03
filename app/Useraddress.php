<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useraddress extends Model
{
	//Address type: 1 For Home , 2 For Office
	//default Address is 1 
    protected $fillable = [
        'user_id','user_name', 'address','city','state','pincode','default','address_type'
    ];
}
