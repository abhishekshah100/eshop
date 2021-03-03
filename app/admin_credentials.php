<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin_credentials extends Model
{
    protected $fillable = [
        'full_name','email','password','role','company_type','company_address','company_city','company_pincode','company_country','company_state','company_phonenumber','account_verify_status',
    ];
}
