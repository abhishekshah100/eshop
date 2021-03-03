<?php

use App\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website_settings = new WebsiteSetting();
        $website_settings->website_name= 'Led';
    	$website_settings->website_logo='1610536577-logo-dark.jpg';
    	$website_settings->website_email='abhisheksaha.led@gmail.com';
        $website_settings->contactno='9876543210';
        $website_settings->address='New Ashok Nagar';
        $website_settings->state='Delhi';
        $website_settings->pincode='110096';
        $website_settings->website_url='http:/http://eshop.leadingedgedesigners.com';
        $website_settings->facebook_url='https://www.facebook.com/';
        $website_settings->twitter_url='https://twitter.com/?lang=en';
        $website_settings->youtube_url='https://www.youtube.com/';
        $website_settings->instagram_url='https://www.instagram.com/';
    	$website_settings->save();
    }
}
