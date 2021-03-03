<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EcommerceSetting extends Model
{
    protected $fillable = [
        'maximum_quantity','pagination',
    ];
}
