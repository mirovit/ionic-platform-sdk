<?php

namespace Mirovit\IonicPlatformSDK\Tests;

use Mirovit\IonicPlatformSDK\Endpoints\DeployEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\Endpoint;
use Mirovit\IonicPlatformSDK\Endpoints\PushEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\UsersEndpoint;
use Mirovit\IonicPlatformSDK\IonicPlatformSDK;
use Mirovit\IonicPlatformSDK\Validators\Validator;

class IonicPlatformSDKTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IonicPlatformSDK
     */
    private $sdk;

    public function setUp()
    {
        $this->sdk = new IonicPlatformSDK('faketoken', 'http://api.fakeserver.com');
    }

    /** @test */
    public function it_is_an_instance_of_endpoint()
    {
        $this->assertInstanceOf(Endpoint::class, $this->sdk);
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
        $this->assertInstanceOf(UsersEndpoint::class, $this->sdk->users());
    }

    /** @test */
    public function it_has_a_push_endpoint()
    {
        $this->assertTrue(method_exists($this->sdk, 'push'));
        $this->assertInstanceOf(PushEndpoint::class, $this->sdk->push());
    }

    /** @test */
    public function it_has_a_deploy_endpoint()
    {
        $this->assertTrue(method_exists($this->sdk, 'deploy'));
        $this->assertInstanceOf(DeployEndpoint::class, $this->sdk->deploy());
    }

    /** @test */
    public function it_has_a_validator_instance()
    {
        $this->assertInstanceOf(Validator::class, $this->sdk->validation());
    }
}