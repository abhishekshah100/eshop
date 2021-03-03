<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Category extends Model
{
    protected $fillable = [
        'categoryname','category_status','slug','metatitle','metakeywords','metadescription','metacanonical','category_image',
    ];

    public function setCategorynameAttribute($value)
	{
	        $this->attributes['categoryname'] = ucwords($value);
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

	public function setCategoryimageAttribute($value)
	{
	        $this->attributes['category_image'] = $value;
	}

	public function getCategoryImageAttribute($value)
    {
        return 'images/category/'.$value;
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }

    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }
}
