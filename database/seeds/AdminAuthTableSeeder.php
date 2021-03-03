<?php

use App\admin_credentials;
use Illuminate\Database\Seeder;

class AdminAuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new admin_credentials();
        $user->full_name= 'Super Admin';
    	$user->email='abhishek@gmail.com';
    	$user->password=bcrypt('abhishek');
        $user->role='1';
        $user->account_verify_status='1';
    	$user->save();
    }
}
