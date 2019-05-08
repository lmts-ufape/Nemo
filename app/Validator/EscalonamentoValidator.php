<?php

namespace nemo\Validator;

use nemo\Validator\ValidationException;

class EscalonamentoValidator{
    public static $rules = [
        'pesoMedio' => 'required',
        'duracaoCiclo' => 'required',
        'periodicidade' => 'required',
        'producaoDesejada' => 'required',
        'inicioProducao' => 'required',
    ];

    public static $messages = [
        'required' => 'O campo ":attribute" não pode ser vazio.'
    ];

    public static function validate($dados){
        $validator = \Validator::make($dados, EscalonamentoValidator::$rules, EscalonamentoValidator::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, $validator->errors());
        }
    }
}

