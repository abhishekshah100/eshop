<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'website_name','website_logo','website_email','contactno','address','state','pincode','website_url','facebook_url','twitter_url','youtube_url','instagram_url',
    ];

    public function setWebsiteNameAttribute($value)
	{
	        $this->attributes['website_name'] = ucwords($value);
	}

	public function setStateAttribute($value)
	{
	        $this->attributes['state'] = ucwords($value);
	}

	public function getWebsiteLogoImageAttribute($value)
    {
        return 'images/website/logo/'.$value;
    }
}
