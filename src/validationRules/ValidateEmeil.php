<?php

class ValidateEmail implements ValidationRulesInterface
{

    public function validateRule(string $value): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) 
        {
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return 'Email is not valid.';
    }
}