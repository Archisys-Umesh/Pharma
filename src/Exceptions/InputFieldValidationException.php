<?php

namespace App\Exceptions;

class InputFieldValidationException extends \Exception
{
    protected $_field;
    protected $_message;
    protected $_code;
    public function __construct($message="", $code=0 , Exception $previous=NULL, $field = NULL)
    {
        $this->_field = $field;
        $this->_message = $message." | Field:".$field;
        $this->code = $code;
        
        parent::__construct($this->_message, $code, $previous);
    }
    public function getField()
    {
        return $this->_field;
    }
    
    public function toArray()
    {
        return [
            "message" => $this->_message,
            "field" => $this->_field,
            "code" => $this->_code,            
        ];
    }
}
