<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PisciculturaSeeder::class);

        //$this->call(TanqueSeeder::class);

        //$this->call(EspecieSeeder::class);
        
        $this->call(QualidadeAguaSeeder::class);
    }
}
