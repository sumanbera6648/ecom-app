<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = [
            [
               'country' =>'India',
            ]
        ];
        foreach ($country as $country){
            Country::create([
                'name' => $country['country']
            ]);
        }
    }
}
