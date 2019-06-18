<?php

use Illuminate\Database\Seeder;

class GerenciarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
        	DB::table('gerenciars')->insert([
                'user_id' => 1,
                'piscicultura_id'=>$i+1
                
                ]
            );
        }
    }
}
