<?php

use App\EcommerceSetting;
use Illuminate\Database\Seeder;

class EcommerceSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ecommerce_settings = new EcommerceSetting();
        $ecommerce_settings->maximum_quantity= '5';
    	$ecommerce_settings->pagination='16';
        $ecommerce_settings->save();
    }
}
