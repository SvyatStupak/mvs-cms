<?php

namespace src\validationRules;

use src\interfaces\ValidationRulesInterface;

class ValidateSpecialCharacter implements ValidationRulesInterface
{
    private $rules;

    public function __construct($rules = '#[^A-Za-z0-9]+#')
    {
        $this->rules = $rules;
    }

    public function validateRule(string $value): bool
    {
        if (!preg_match($this->rules, $value)) 
        {
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return 'You need special character';
    }
}