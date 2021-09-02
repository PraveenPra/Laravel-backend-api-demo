<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        foreach(range(1,10)as $value)
        {
            DB::table('hospitals')->insert([
                'name'=>$faker->firstName(),
                "email"=>$faker->unique()->email,
                'phone'=>$faker->e164PhoneNumber(),
                'address'=>$faker->address(),
            ]);
        }
    }
}
