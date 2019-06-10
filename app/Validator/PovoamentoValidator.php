<?php

namespace nemo\Validator;

use nemo\Povoamento;
use nemo\Validator\ValidationException;

class PovoamentoValidator{
  public static function validate($dados){

    $validator = \Validator::make($dados, Povoamento::$rules, Povoamento::$messages);
    
    if(!$validator->errors()->isEmpty()){
      throw new ValidationException($validator, $validator->errors());
    }
  }
}