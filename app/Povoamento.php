<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class Povoamento extends Model
{
	 protected $fillable = ['tanque_id', 'especie_id', 'data', 'quantidade'];
    public $timestamps = false;	
	
    public function tanque(){
        return $this->belongsTo('nemo\Tanque', 'tanque_id');
    }

    public function especie(){
        return $this->belongsTo('nemo\EspeciePeixe', 'especie_id');
    }
}
