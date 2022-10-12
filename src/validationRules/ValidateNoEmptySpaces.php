<?php

namespace src\validationRules;

use src\interfaces\ValidationRulesInterface;

class ValidateNoEmptySpaces implements ValidationRulesInterface
{
    public function validateRule(string $value): bool
    {
        if (strpos($value, ' ') === false) 
        {
            return true;
        }
        return false;
    }

    public function getErrorMessage(): string
    {
        return 'space is an invalid character';
    }
}