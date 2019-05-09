<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    public function tanque(){
        return $this->belongsTo('nemo\Tanque', 'tanque_id');
    }

    public function biometrias(){
		return $this->hasMany(Biometria::class);
    }
    
    public function qualidade_agua(){
    	return $this->hasOne(QualidadeAgua::class);
    }
     
    public function povoamento(){
    	return $this->hasOne(Povoamento::class);
    }

    public function pesca(){
        return $this->hasOne(Pesca::class);
    }
}
