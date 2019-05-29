<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class Povoamento extends Model
{
	 protected $fillable = ['ciclo_id','especie_id', 'data', 'quantidade','peso'];
    public $timestamps = false;	
	
    public function ciclo(){
    	return $this->belongsTo(Ciclo::class, 'ciclo_id');
	}

    public function especie(){
        return $this->belongsTo('nemo\EspeciePeixe', 'especie_id');
    }
}
