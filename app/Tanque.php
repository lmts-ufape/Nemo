<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

use nemo\Piscicultura;

class Tanque extends Model
{
	public $timestamps = false;
	protected $fillable = ['nome','volume','area','altura'];
    
    
    public static $rules = [
        'nome' => 'required|max:20',
        'volume' => 'required|numeric|min:0|max:2147483647',
        'area' => 'numeric|min:0|max:2147483647|nullable',
        'altura' => 'numeric|min:0|max:2147483647|nullable',
    ];

    public static $messages = [
        'required' => 'O campo ":attribute" não pode ser vazio.',
        'numeric' => 'O campo ":attribute" precisa ser numérico.',
    	'nome.max' => 'O nome do tanque deve ter no maximo :max caracteres.',
    	'max' => 'Valor do campo ":attribute" excede o limite.',
        'min' => 'O campo ":attribute" não pode ser menor que :min',
    ];
    
    public function piscicultura(){
    	return $this->belongsTo(Piscicultura::class);
    }
    
    public function ciclos(){
        return $this->hasMany(Ciclo::class);
    }
   
}

