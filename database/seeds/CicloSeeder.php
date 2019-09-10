<?php

use Illuminate\Database\Seeder;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 60; $i++){
            DB::table('ciclos')->insert([
                'tanque_id'=> $i+1,
            ]);        
        }
    }
}
