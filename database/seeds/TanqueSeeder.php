<?php

use Illuminate\Database\Seeder;

class TanqueSeeder extends Seeder
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
        $tanque = DB::table('tanques')->insert([
          'nome'=> 'tanque-'.$i,
          'volume' => 20000,
          'piscicultura_id' => rand(1,5)
        ]);
        
      }
  }
}