<?php

use Illuminate\Database\Seeder;

class QualidadeAguaSeeder extends Seeder
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
            DB::table('qualidade_aguas')->insert([
                'ciclo_id'=> $i+1,
            ]);        
        }
    }
}
