<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\ESS\Exceptions;

use Illuminate\Validation\Validator as V;

/**
 * Description of Validator
 *
 * @author Plus91Labs-01
 */
class Validator {

    /**
     * List of constraints
     *
     * @var array
     */
    protected $rules = [];

    /**
     * List of customized messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * List of returned errors in case of a failing assertion
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Just another constructor
     *
     * @return void
     */
    public function __construct() {
        $this->initRules();
        $this->initMessages();
    }

    /**
     * Set the user subscription constraints
     *
     * @return void
     */
    public function initRules() {
        return [
            'phone' => 'required',
            'isd_code' => 'required',
        ];
    }

    /**
     * Set user custom error messages
     *
     * @return void
     */
    public function initMessages() {
        return [
            'phone.required' => 'Please enter email address.',
            'isd_code.required' => 'Please enter ISD code.',
        ];
    }

}
