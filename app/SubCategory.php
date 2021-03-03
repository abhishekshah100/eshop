<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    protected $fillable = [
        'category_id','sub_categoryname','sub_category_status','slug','metatitle','metakeywords','metadescription','metacanonical','sub_category_image',
    ];

    public function setSubCategorynameAttribute($value)
	{
	        $this->attributes['sub_categoryname'] = ucwords($value);
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

	public function setSubCategoryimageAttribute($value)
	{
	        $this->attributes['sub_category_image'] = $value;
	}

	public function getSubCategoryImageAttribute($value)
    {
        return 'images/sub_category/'.$value;
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
}
