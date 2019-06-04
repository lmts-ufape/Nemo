<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class Biometria extends Model
{
    public $timestamps = false;
	protected $fillable = ['quantidade','peso', 'peso_medio', 'data', 'hora'];

	public static $rules = [
		'quantidade' => 'required|numeric',
		'peso' => 'required|numeric',
		'data' => 'required',
		'hora' => 'required',
	];

	public static $messages = [
		'required' => 'O campo ":attribute" não pode ser vazio.',
		'numeric' => 'O campo ":attribute" precisa ser numérico.',
	];

    public function ciclo(){
    	return $this->belongsTo(Ciclo::class, 'ciclo_id');
	}

}
