<?php

namespace Modules\Classes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Classes\Entities\Classes;
use Carbon\Carbon;

class ClassesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();
        // $this->call("OthersTableSeeder");

        Classes::truncate();
        Classes::insert([
            'name' => 'Lớp 10',
            'school_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Classes::insert([
            'name' => 'Lớp 11',
            'school_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Classes::insert([
            'name' => 'Lớp 12',
            'school_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }
}
