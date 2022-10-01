<?php

class Validation
{
    private $rules;

    public function addRule($rule)
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
                $this->rules = [];
                return false;
            }
        }
        $this->rules = [];
        return true;
    }

    // public function clearRules()
    // {
    //     $this->rules = [];
    // }
}