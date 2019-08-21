<?php

use App\Cities;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cities::firstOrCreate(['name'=>'Dubai'], [
            'description'=>'',
        ]);
        Cities::firstOrCreate(['name'=>'Харьков'], [
            'description'=>'',
        ]);

    }
}
