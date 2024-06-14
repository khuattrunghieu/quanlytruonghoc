<?php

use Illuminate\Database\Seeder;
use App\Models\Account;
use Carbon\Carbon;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::truncate();
        
        Account::insert([
            'name' => 'Teacher',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Account::insert([
            'name' => 'Student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
