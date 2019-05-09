<?php

namespace nemo\Validator;

use nemo\Tanque;
use nemo\Validator\ValidationException;

class TanqueValidator{
  public static function validate($dados){

    $validator = \Validator::make($dados, Tanque::$rules, Tanque::$messages);
    
    if(!$validator->errors()->isEmpty()){
      throw new ValidationException($validator, $validator->errors());
    }
  }
}