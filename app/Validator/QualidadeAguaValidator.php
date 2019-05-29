<?php

namespace nemo\Validator;

use nemo\QualidadeAgua;
use nemo\Validator\ValidationException;

class QualidadeAguaValidator{
  public static function validate($dados){

    $validator = \Validator::make($dados, QualidadeAgua::$rules, QualidadeAgua::$messages);
    
    if(!$validator->errors()->isEmpty()){
      throw new ValidationException($validator, $validator->errors());
    }
  }
}