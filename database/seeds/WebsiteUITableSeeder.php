<?php

use App\Websiteui;
use Illuminate\Database\Seeder;

class WebsiteUITableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website_ui1 = new Websiteui();
        $website_ui1->websiteui_images= 'images/websiteui/premium_products/12.jpg,images/websiteui/premium_products/10.jpg,images/websiteui/premium_products/11.jpg';
    	$website_ui1->websiteui_link='http://127.0.0.1:8000/product-detail/preston-metz,http://127.0.0.1:8000/product-detail/preston-metz,http://127.0.0.1:8000/product-detail/preston-metz';
        $website_ui1->save();

        $website_ui2 = new Websiteui();
        $website_ui2->websiteui_images= 'images/websiteui/popular_categories/popular_category.png';
    	$website_ui2->websiteui_link=NULL;
        $website_ui2->save();

        $website_ui3 = new Websiteui();
        $website_ui3->websiteui_images= 'images/websiteui/offer_banners/offer.jpg,images/websiteui/offer_banners/offer.jpg';
    	$website_ui3->websiteui_link='http://127.0.0.1:8000/product-detail/preston-metz,http://127.0.0.1:8000/product-detail/preston-metz';
        $website_ui3->save();
    }
}
