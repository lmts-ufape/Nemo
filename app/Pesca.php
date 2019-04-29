<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class Pesca extends Model
{
    protected $fillable = ['tanque_id', 'peso', 'data', 'hora'];
    public $timestamps = false;	
	
    public function ciclo(){
    	return $this->belongsTo(Ciclo::class, 'ciclo_id');
	}

}
