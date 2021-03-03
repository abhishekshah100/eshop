<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_name','contact_email','contact_no','contact_message',
    ];

    public function setContactNameAttribute($value)
	{
	        $this->attributes['contact_name'] = ucwords($value);
	}
}
