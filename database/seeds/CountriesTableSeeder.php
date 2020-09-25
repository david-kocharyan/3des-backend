<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $countries = array(
            [
                'id' => 1,
                'name' => 'Canada',
                'code' => 'CA',
            ],

            [
                'id' => 2,
                'name' => 'United States',
                'code' => 'US',
            ]
        );
        Country::insert($countries);
    }
}
