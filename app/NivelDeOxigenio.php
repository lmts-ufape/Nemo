<?php

namespace nemo;

use Illuminate\Database\Eloquent\Model;

class NivelDeOxigenio extends Model
{
    public $timestamps = false;
    protected $fillable = ['valor', 'data','hora'];
    
    public function QualidadeAgua(){
    	return $this->belongsTo(QualidadeAgua::class);
    }
}
