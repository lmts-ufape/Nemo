<?php

namespace nemo\Validator;

use nemo\Piscicultura;
use nemo\Validator\ValidationException;

class PisciculturaValidator{
  public static function validate($dados){

    $validator = \Validator::make($dados, Piscicultura::$rules, Piscicultura::$messages);
    
    if(!$validator->errors()->isEmpty()){
      throw new ValidationException($validator, $validator->errors());
    }
  }
}