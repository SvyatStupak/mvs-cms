<?php

namespace src\validationRules;

use src\interfaces\ValidationRulesInterface;

class ValidateMinimum implements ValidationRulesInterface
{
    private $minimum;

    public function __construct($minimum)
    {
        $this->minimum = $minimum;
    }

    public function validateRule(string $value): bool
    {
        if (strlen($value) < $this->minimum) 
        {
            return false;
        }

        return true;
    }
    
    public function getErrorMessage(): string
    {
        return "You need more $this->minimum character";
    }
}