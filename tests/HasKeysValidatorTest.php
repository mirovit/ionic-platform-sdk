<?php

use Mirovit\IonicPlatformSDK\Validators\HasKeys;

class HasKeysValidatorTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_validates_an_array_with_equal_key_size()
    {
        $validator = new HasKeys(['id'], ['id' => 1]);
        $this->assertTrue($validator->validate());
    }

    /** @test */
    public function it_validates_an_array_with_more_keys()
    {
        $validator = new HasKeys(['id'], ['id' => 1, 'name' => 'John Doe', 'email' => 'john@doe.com']);
        $this->assertTrue($validator->validate());
    }

    /** @test */
    public function it_validates_multiple_keys()
    {
        $validator = new HasKeys(['id', 'name'], ['id' => 1, 'name' => 'John Doe', 'email' => 'john@doe.com']);
        $this->assertTrue($validator->validate());
    }

    /** @test */
    public function it_does_not_validate_when_a_required_key_is_missing()
    {
        $validator = new HasKeys(['id'], ['name' => 'John Doe']);
        $this->assertFalse($validator->validate());
    }
}
