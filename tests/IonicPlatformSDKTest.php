<?php

class IonicPlatformSDKTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Mirovit\IonicPlatformSDK\IonicPlatformSDK
     */
    private $sdk;

    public function setUp()
    {
        $this->sdk = new \Mirovit\IonicPlatformSDK\IonicPlatformSDK('faketoken', 'http://api.fakeserver.com');
    }

    /** @test */
    public function it_is_an_instance_of_endpoint()
    {
        $this->assertInstanceOf(\Mirovit\IonicPlatformSDK\Endpoints\Endpoint::class, $this->sdk);
    }

    /** @test */
    public function it_sets_correct_endpoint()
    {
        $this->assertSame('http://api.fakeserver.com', $this->sdk->getEndpoint());
    }

    /** @test */
    public function it_has_an_users_endpoint()
    {
        $this->assertTrue(method_exists($this->sdk, 'users'));
        $this->assertInstanceOf(\Mirovit\IonicPlatformSDK\Endpoints\UsersEndpoint::class, $this->sdk->users());
    }

    /** @test */
    public function it_has_a_push_endpoint()
    {
        $this->assertTrue(method_exists($this->sdk, 'push'));
        $this->assertInstanceOf(\Mirovit\IonicPlatformSDK\Endpoints\PushEndpoint::class, $this->sdk->push());
    }

    /** @test */
    public function it_has_a_deploy_endpoint()
    {
        $this->assertTrue(method_exists($this->sdk, 'deploy'));
        $this->assertInstanceOf(\Mirovit\IonicPlatformSDK\Endpoints\DeployEndpoint::class, $this->sdk->deploy());
    }

    /** @test */
    public function it_has_a_validator_instance()
    {
        $this->assertInstanceOf(\Mirovit\IonicPlatformSDK\Validators\Validator::class, $this->sdk->validation());
    }
}