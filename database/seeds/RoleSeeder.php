<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::insert([
            [
                'user_id' => 1,
                'category_id' => 1,
                'view' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'category_id' => 2,
                'view' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'category_id' => 3,
                'view' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'view' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        Role::insert([
            [
                'user_id' => 2,
                'category_id' => 1,
                'view' => 1,
                'add' => 0,
                'edit' => 0,
                'delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'category_id' => 2,
                'view' => 1,
                'add' => 0,
                'edit' => 0,
                'delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'category_id' => 3,
                'view' => 1,
                'add' => 0,
                'edit' => 0,
                'delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'category_id' => 4,
                'view' => 1,
                'add' => 0,
                'edit' => 0,
                'delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
