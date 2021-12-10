<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $state = [
        [
            'state' =>'West Bengal',
            'country_id'=>'1'
        ],
        [
            'state' =>'Kerala',
            'country_id'=>'1'
        ],
        [
            'state' =>'Madhya Pradesh',
            'country_id'=>'1'
        ],
        [
            'state' =>'Maharashtra',
            'country_id'=>'1'
        ],
        [
            'state' =>'Odisha',
            'country_id'=>'1'
        ],
        [
            'state' =>'Sikkim',
            'country_id'=>'1'
        ],
        [
            'state' =>'Uttar Pradesh',
            'country_id'=>'1'
        ],
        [
            'state' =>'United States',
            'country_id'=>'2'
        ],
        [
            'state' =>'Alberta',
            'country_id'=>'3'
        ],
       ];
       foreach($state as $state){
           State::create([

               'name'=> $state['state'],
               'country_id'=>$state['country_id'],
           ]);
       }


    }
}
