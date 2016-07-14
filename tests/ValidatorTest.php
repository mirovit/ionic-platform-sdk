<?php

namespace Mirovit\IonicPlatformSDK\Tests;

use Mirovit\IonicPlatformSDK\Validators\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new Validator;
    }
    /** @test */
    public function it_fails_to_validate_when_the_validator_does_not_exist()
    {
        $this->assertFalse($this->validator->nonExistentValidator());
    }

    /** @test */
    public function it_calls_the_correct_validator()
    {
        $this->assertTrue($this->validator->hasKeys(['id'], ['id' => 1]));
    }
}
