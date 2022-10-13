<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use src\Validation;
use src\validationRules\ValidateEmail;

require_once 'src/interfaces/ValidationRulesInterface.php';
require_once 'src/Validation.php';
require_once 'src/validationRules/ValidateEmeil.php';

final class ValidationTest extends TestCase
{
    public function testValidationEmail(): void
    {
        $validationClass = new Validation();
        $validationClass->addRule(new ValidateEmail());

        $this->assertTrue($validationClass->validate('test@test.com'));
        // $this->assertFalse($validationClass->validate('test'));
    }

}