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
        $this->call(UsersSeeder::class);

        //$this->call(PisciculturaSeeder::class);

        //$this->call(GerenciarSeeder::class);

        //$this->call(TanqueSeeder::class);

        //$this->call(CicloSeeder::class);

        //$this->call(QualidadeAguaSeeder::class);

        $this->call(EspecieSeeder::class);

        //$this->call(TemperaturaSeeder::class);

        
        //$this->call(QualidadeAguaSeeder::class);
    }
}
