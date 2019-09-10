<?php

namespace nemo\Validator;

use nemo\Biometria;
use nemo\Validator\ValidationException;

class BiometriaValidator{
  public static function validate($dados){

    $validator = \Validator::make($dados, Biometria::$rules, Biometria::$messages);
    
    if(!$validator->errors()->isEmpty()){
      throw new ValidationException($validator, $validator->errors());
    }
  }
}