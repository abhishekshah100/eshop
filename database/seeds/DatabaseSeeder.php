<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(AdminAuthTableSeeder::class);
        $this->call(EcommerceSettingsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(WebsiteUITableSeeder::class);
        $this->call(WebsiteSettingsTableSeeder::class);
        $this->call(HomeSliderTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
