<?php

class Validation
{
    private $rules;
    private $errors = [];


    public function addRule(ValidationRulesInterface $rule)
    {
        $this->rules[] = $rule;
        return $this;
    }

    public function validate($value)
    {
        foreach ($this->rules as $rule) {
            $ruleValidation = $rule->validateRule($value);
            if (!$ruleValidation) 
            {
                $this->errors[] = $rule->getErrorMessage();
                $this->rules = [];
                return false;
            }
        }
        $this->errors = [];
        $this->rules = [];
        return true;
    }

    public function getAllErrors()
    {
        return $this->errors;
    }
    


}