<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class QualidadeAgua extends Model
{
	public $timestamps = false;
	protected $fillable = ['ph', 'nivelOxigenio', 'temperatura', 'nivelAmonia', 'nitrito', 'nitrato', 'alcalinidade', 'dureza', 'data'];

	public static $rules = [
			'ph' => 'required|numeric|min:0|max:14',
			'nivelOxigenio' => 'required|numeric',
			'temperatura' => 'required|numeric',
			'nivelAmonia' => 'required|numeric',
			'nitrito' => 'required|numeric',
			'nitrato' => 'required|numeric',
			'alcalinidade' => 'required|numeric',
			'dureza' => 'required|numeric',
	];

	public static $messages = [
		'required' => 'O campo ":attribute" não pode ser vazio.',
		'numeric' => 'O campo ":attribute" precisa ser numérico.',
	];

    public function tanque(){
    	return $this->belongsTo(Tanque::class, 'tanque_id');
	}
	
	public function phs(){
		return $this->hasMany(Ph::class);
	}
	public function temperaturas(){
		return $this->hasMany(Temperatura::class);
	}
}
