<?php

use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('especie_peixes')->insert([
            'nome' => 'Tilápia',
            'tipo_racao' => 'Pó Fino',
            'temperatura_ideal_agua' => 28,
            'quantidade_por_volume' => 50
        ]);
    
    }
}