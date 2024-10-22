<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Modules\ESS\Exceptions;
/**
 * Description of InvalidFlow
 *
 * @author archisys8
 */
class  InvalidArgumentException extends \Exception
{
    protected $_field;
    public function __construct($message="", $code=0 , Exception $previous=NULL, $field = NULL)
    {
        $this->_field = $field;
        parent::__construct($message, $code, $previous);
    }
    public function getField()
    {
        return $this->_field;
    }
}
