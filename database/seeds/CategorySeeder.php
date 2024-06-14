<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::insert([
            'name' => 'Student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Category::insert([
            'name' => 'Teacher',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Category::insert([
            'name' => 'Class',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Category::insert([
            'name' => 'School',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
