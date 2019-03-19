<?php
namespace nemo\Validator;

class ValidationException extends \Exception{
    protected $validator;
    public function __construct($validator, $text = 'TODO: write validator text'){
        parent::__construct($text);
        $this->validator = $validator;
    }
    public function getValidator() {
		    return $this->validator;
    }
}