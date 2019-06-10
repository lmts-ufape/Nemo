<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class Pesca extends Model
{
    protected $fillable = ['tanque_id', 'peso', 'data', 'hora'];
    public $timestamps = false;	

    public static $rules = [
		'peso' => 'required|numeric|max:2147483647',
		'data' => 'required',
		'hora' => 'required',
	];

	public static $messages = [
		'required' => 'O campo ":attribute" não pode ser vazio.',
		'numeric' => 'O campo ":attribute" precisa ser numérico.',
    'max' => 'Valor do campo ":attribute" excede o limite.',
	];
	
    public function ciclo(){
    	return $this->belongsTo(Ciclo::class, 'ciclo_id');
	}

}
