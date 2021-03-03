<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $fillable = [
        'brandname','brand_status','slug','metatitle','metakeywords','metadescription','metacanonical','brand_logo',
    ];

    public function setBrandnameAttribute($value)
	{
	        $this->attributes['brandname'] = ucwords($value);
	        $this->attributes['slug'] = Str::slug(strtolower($value),'-');
	}

	public function setMetatitleAttribute($value)
	{
	        $this->attributes['metatitle'] = ucwords($value);
	}

	public function setMetadescriptionAttribute($value)
	{
	        $this->attributes['metadescription'] = ucfirst($value);
	}

	public function getBrandLogoAttribute($value)
    {
        return 'images/brand/'.$value;
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
