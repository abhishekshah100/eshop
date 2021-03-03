<?php

use App\Homeslider;
use Illuminate\Database\Seeder;

class HomeSliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home_sliders1 = new Homeslider();
        $home_sliders1->main_heading= 'Wireless Earbuds';
    	$home_sliders1->sub_heading='Test1Shots X1 Air';
    	$home_sliders1->sub_sub_heading='Truly Wireless Earbuds';
        $home_sliders1->link='http://127.0.0.1:8000/product-detail/preston-metz';
        $home_sliders1->slider_image='images/websiteui/slider_images/slide1.jpg';
        $home_sliders1->status='1';
    	$home_sliders1->save();

    	$home_sliders2 = new Homeslider();
        $home_sliders2->main_heading= 'JBL Charge 4 Portable';
    	$home_sliders2->sub_heading='The New Arrivals';
    	$home_sliders2->sub_sub_heading='Portable Bluetooth Speakers';
        $home_sliders2->link='www.google.com';
        $home_sliders2->slider_image='images/websiteui/slider_images/slide2.jpg';
        $home_sliders2->status='1';
    	$home_sliders2->save();

    	$home_sliders3 = new Homeslider();
        $home_sliders3->main_heading= 'Test';
    	$home_sliders3->sub_heading='Test';
    	$home_sliders3->sub_sub_heading='Test';
        $home_sliders3->link='www.google.com';
        $home_sliders3->slider_image='images/websiteui/slider_images/slide3.jpg';
        $home_sliders3->status='1';
    	$home_sliders3->save();
    }
}
