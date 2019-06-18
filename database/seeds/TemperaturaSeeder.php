<?php

use Illuminate\Database\Seeder;

class TemperaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data  = date("Y-m-d", strtotime('1990-02-01'));
        $data = strtotime($data);
        for($i = 0; $i < 30; $i++){
            $data = $data+86400;
            $data1 = date("Y-m-d", $data);
            //dd($data1);
            $hora = date("h:i:s", $data);
            DB::table('temperaturas')->insert([
                'valor'=> mt_rand(20.0,25.0),
                'data' => $data1,
                'hora' => $hora,
                'qualidade_agua_id'=>1
        ]);
        
        
        }
    }
}
