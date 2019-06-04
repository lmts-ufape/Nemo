<?php

namespace nemo\Validator;

use nemo\Validator\ValidationException;

class EscalonamentoValidator{
    public static $rules = [
        'pesoMedio' => 'required|numeric',
        'duracaoCiclo' => 'required|numeric',
        'periodicidade' => 'required',
        'producaoDesejada' => 'required|numeric',
        'inicioProducao' => 'required|date',
    ];

    public static $messages = [
        'required' => 'O campo ":attribute" não pode ser vazio.',
        'numeric' => 'O campo ":attribute" deve ser numérico.'
    ];

    public static function validate($dados){
        $validator = \Validator::make($dados, EscalonamentoValidator::$rules, EscalonamentoValidator::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, $validator->errors());
        }
    }
}
