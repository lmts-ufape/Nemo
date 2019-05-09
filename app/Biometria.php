<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class Biometria extends Model
{
    public $timestamps = false;
	protected $fillable = ['quantidade','peso_total', 'peso_medio', 'data', 'hora'];

    public function ciclo(){
    	return $this->belongsTo(Ciclo::class, 'ciclo_id');
	}

}
