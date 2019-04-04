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
        'nome' => 'required',
        'volume' => 'required|numeric|min:0',
        'area' => 'numeric|min:0|nullable',
        'altura' => 'numeric|min:0|nullable',
    ];

    public static $messages = [
        'required' => 'O campo ":attribute" não pode ser vazio.',
        'numeric' => 'O campo ":attribute" precisa ser numérico.',
        'min' => 'O campo ":attribute" não pode ser menor que :min',
    ];
    
    public function piscicultura(){
    	return $this->belongsTo(Piscicultura::class);
    }

    public function qualidade_aguas(){
    	return $this->hasOne(QualidadeAgua::class);
    }
    
    public function povoamentos(){
        return $this->hasMany(Povoamento::class);
    }
    
    public function pescas(){
        return $this->hasMany(Pesca::class);
    }
}

