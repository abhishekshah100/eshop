<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    
    protected $fillable = [
        'product_code','product_name','product_sku','product_category','product_brand','old_price','new_price','discount','product_stock','feature_image','product_images','product_description','metatitle','metakeywords','metadescription','metacanonical','product_status','slug','remaining_stock','hot_deals','hot_deals_expiry_date','original_old_price','original_new_price','original_discount',
    ];

    public function setProductNameAttribute($value)
    {
            $this->attributes['product_name'] = ucwords($value);
            $this->attributes['slug'] = Str::slug(strtolower($value),'-');
            $this->attributes['metatitle'] = ucwords($value);
    }

    public function setProductDescriptionAttribute($value)
    {
            $this->attributes['product_description'] = $value;
            $this->attributes['metadescription'] = ucfirst($value);
    }

    public function setFeatureImageAttribute($value)
    {
            $this->attributes['feature_image'] = $value;
    }

    public function getFeatureImageAttribute($value)
    {
        return 'images/products/'.$value;
    }

    public function category()
    {
        return $this->belongsTo('App\Category','product_category','id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand','product_brand','id');
    }

    public function hotdeal()
    {
        return $this->hasMany('App\Hotdeal');
    }

    public function users()
    {
        return $this->belongsToMany('App\User','carts','product_id','user_id');
    }
}
