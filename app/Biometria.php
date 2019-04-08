<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class Biometria extends Model
{
    public $timestamps = false;
	protected $fillable = ['peso', 'data', 'hora'];

    public function tanque(){
    	return $this->belongsTo(Tanque::class, 'tanque_id');
	}

}
