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
        for($i = 0;$i<5;$i++) {
        		$data = strtotime(mt_rand (10 ,30).':'.mt_rand (10 ,12).':'.mt_rand (10 ,50));
    			$hora = strtotime(mt_rand (10 ,12).':'.mt_rand (10 ,12));
        		DB::table('phs')->insert([
                    'valor' => mt_rand (1 ,14),
                    'data'=>$data,
                    'hora'=>$hora,
                    'qualidade_agua_id'=>1
                ]);
                DB::table('amonias')->insert([
                    'valor' => mt_rand (1 ,14),
                    'data'=>$data,
                    'hora'=>$hora,
                    'qualidade_agua_id'=>1
                ]);
                DB::table('nitritos')->insert([
                    'valor' => mt_rand (1 ,14),
                    'data'=>$data,
                    'hora'=>$hora,
                    'qualidade_agua_id'=>1
                ]);
                DB::table('nitratos')->insert([
                    'valor' => mt_rand (1 ,14),
                    'data'=>$data,
                    'hora'=>$hora,
                    'qualidade_agua_id'=>1
                ]);
                DB::table('nivel_de_oxigenios')->insert([
                    'valor' => mt_rand (1 ,14),
                    'data'=>$data,
                    'hora'=>$hora,
                    'qualidade_agua_id'=>1
                ]);
                DB::table('durezas')->insert([
                    'valor' => mt_rand (1 ,14),
                    'data'=>$data,
                    'hora'=>$hora,
                    'qualidade_agua_id'=>1
                ]);
                DB::table('alcalinidades')->insert([
                    'valor' => mt_rand (1 ,14),
                    'data'=>$data,
                    'hora'=>$hora,
                    'qualidade_agua_id'=>1
                ]);
                DB::table('temperaturas')->insert([
                    'valor' => mt_rand (1 ,14),
                    'data'=>$data,
                    'hora'=>$hora,
                    'qualidade_agua_id'=>1
                ]);

        	}
    }
}
