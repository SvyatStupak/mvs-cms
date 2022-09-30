<?php

class ValidateMaximum
{
    private $maximum;

    public function __construct($maximum)
    {
        $this->maximum = $maximum;
    }

    public function validateRule($value)
    {
        if (strlen($value) > $this->maximum) 
        {
            return false;
        }

        return true;
    }
}