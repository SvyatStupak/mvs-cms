<?php

class ValidateMaximum implements ValidationRulesInterface
{
    private $maximum;

    public function __construct($maximum)
    {
        $this->maximum = $maximum;
    }

    public function validateRule(string $value): bool
    {
        if (strlen($value) > $this->maximum) 
        {
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return "You need less $this->maximum character";
    }
}