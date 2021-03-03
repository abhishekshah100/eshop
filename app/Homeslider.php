<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homeslider extends Model
{
    protected $fillable = [
        'main_heading','sub_heading','sub_sub_heading','link','slider_image','status',
    ];
}
