<?php

use Illuminate\Database\Seeder;

class PisciculturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        for($i = 0; $i < 5; $i++) {
        	DB::table('pisciculturas')->insert([
                'nome' => 'Piscicultura-'.$faker->word]
            );
        }
    }
}
