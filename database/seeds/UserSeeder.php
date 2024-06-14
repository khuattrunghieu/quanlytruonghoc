<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::insert([
            'name' => 'teacher',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'address' => 'Nhà không số, Phố không tên',
            'phone' => '1234567890',
            'birthday' => '1991-01-05',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'account_id' => 1
        ]);

        User::insert([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('123456789'),
            'address' => 'Nhà không số, Phố không tên',
            'phone' => '1234567890',
            'birthday' => '1991-01-05',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'account_id' => 2
        ]);
    }
}
