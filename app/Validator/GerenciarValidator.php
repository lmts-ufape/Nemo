<?php

namespace nemo\Validator;

use nemo\Gerenciar;
use nemo\Validator\ValidationException;

class GerenciarValidator{
  public static function validate($dados){

    $validator = \Validator::make($dados, Gerenciar::$rules, Gerenciar::$messages);
    
    if(!$validator->errors()->isEmpty()){
      throw new ValidationException($validator, $validator->errors());
    }
  }
}