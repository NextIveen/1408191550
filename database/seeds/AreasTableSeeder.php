<?php

use App\Areas;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Areas::firstOrCreate(['name'=>'Business Bay Area'], [
            'description'=>'',
        ]);
        Areas::firstOrCreate(['name'=>'Киевская'], [
            'description'=>'',
        ]);
    }
}
