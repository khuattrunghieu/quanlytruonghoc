<?php

namespace Modules\School\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\School\Entities\School;

class SchoolDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call("SchoolDatabaseSeeder");
        School::truncate();
        School::insert([
            'name' => 'Trường số 1',
            'address' => 'Đường không số, Phố không tên',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        School::insert([
            'name' => 'Trường số 2',
            'address' => 'Đường không số, Phố không tên',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        School::insert([
            'name' => 'Trường số 3',
            'address' => 'Đường không số, Phố không tên',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
