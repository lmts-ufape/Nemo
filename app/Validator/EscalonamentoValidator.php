<?php

namespace nemo\Validator;

use nemo\Validator\ValidationException;

class EscalonamentoValidator{
    public static $rules = [
        'pesoMedio' => 'required|numeric|max:2147483647',
        'duracaoCiclo' => 'required|numeric|max:2147483647',
        'periodicidade' => 'required',
        'producaoDesejada' => 'required|numeric|max:2147483647',
        'inicioProducao' => 'required|date',
    ];

    public static $messages = [
        'required' => 'O campo ":attribute" não pode ser vazio.',
        'numeric' => 'O campo ":attribute" deve ser numérico.',
        'max' => 'Valor do campo ":attribute" excede o limite.',
    ];

    public static function validate($dados){
        $validator = \Validator::make($dados, EscalonamentoValidator::$rules, EscalonamentoValidator::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, $validator->errors());
        }
    }
}
