<?php

class ValidateSpecialCharacter
{
    private $rules;

    public function __construct($rules = '#[^A-Za-z0-9]+#')
    {
        $this->rules = $rules;
    }

    public function validateRule($value)
    {
        if (!preg_match($this->rules, $value)) 
        {
            return false;
        }

        return true;
    }
}