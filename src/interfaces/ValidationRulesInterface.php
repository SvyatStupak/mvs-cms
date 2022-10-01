<?php

interface ValidationRulesInterface
{
    public function validateRule(string $value) : bool;

    public function getErrorMessage() : string;
}