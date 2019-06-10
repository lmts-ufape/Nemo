<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class QualidadeAgua extends Model
{
	public $timestamps = false;
	protected $fillable = ['ph', 'nivelOxigenio', 'temperatura', 'nivelAmonia', 'nitrito', 'nitrato', 'alcalinidade', 'dureza', 'data'];

	public static $rules = [
			'ph' => 'required|numeric|min:0|max:14',
			'nivelOxigenio' => 'required|numeric|max:2147483647',
			'temperatura' => 'required|numeric|max:2147483647',
			'nivelAmonia' => 'required|numeric|max:2147483647',
			'nitrito' => 'required|numeric|max:2147483647',
			'nitrato' => 'required|numeric|max:2147483647',
			'alcalinidade' => 'required|numeric|max:2147483647',
			'dureza' => 'required|numeric|max:2147483647',
	];

	public static $messages = [
		'required' => 'O campo ":attribute" não pode ser vazio.',
		'numeric' => 'O campo ":attribute" precisa ser numérico.',
    	'max' => 'Valor do campo ":attribute" excede o limite.',

	];

    public function ciclo(){
    	return $this->belongsTo(Ciclo::class, 'ciclo_id');
	}	
	public function phs(){
		return $this->hasMany(Ph::class);
	}
	public function temperaturas(){
		return $this->hasMany(Temperatura::class);
	}
	public function amonias(){
		return $this->hasMany(Amonia::class);
	}
	public function nitritos(){
		return $this->hasMany(Nitrito::class);
	}
	public function nitratos(){
		return $this->hasMany(Nitrato::class);
	}
	public function durezas(){
		return $this->hasMany(Dureza::class);
	}
	public function alcalinidades(){
		return $this->hasMany(Alcalinidade::class);
	}
	public function oxigenios(){
		return $this->hasMany(NivelDeOxigenio::class);
	}
}
