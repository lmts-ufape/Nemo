<?php

namespace nemo\Validator;

use nemo\Pesca;
use nemo\Validator\ValidationException;

class PescaValidator{
  public static function validate($dados){

    $validator = \Validator::make($dados, Pesca::$rules, Pesca::$messages);
    
    if(!$validator->errors()->isEmpty()){
      throw new ValidationException($validator, $validator->errors());
    }
  }
}