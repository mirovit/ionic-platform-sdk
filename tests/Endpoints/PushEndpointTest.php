<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\Endpoint;
use Mirovit\IonicPlatformSDK\Endpoints\MessagesEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\NotificationsEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\PushEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\TokensEndpoint;

class PushEndpointTest extends AbstractEndpointTest
{
    /**
     * @var PushEndpoint
     */
    private $push;

    public function setUp()
    {
        parent::setUp();
        $this->push = new PushEndpoint($this->client->reveal(), 'http://api.fakeserver.com');
    }

    /** @test */
    public function it_is_an_instance_of_endpoint()
    {
        $this->assertInstanceOf(Endpoint::class, $this->push);
    }

    /** @test */
    public function it_sets_correct_endpoint()
    {
        $this->assertSame('http://api.fakeserver.com/push', $this->push->getEndpoint());
    }

    /** @test */
    public function it_has_notifications_endpoint()
    {
        $this->assertTrue(method_exists($this->push, 'notifications'));
        $this->assertInstanceOf(NotificationsEndpoint::class, $this->push->notifications());
    }

    /** @test */
    public function it_has_messages_endpoint()
    {
        $this->assertTrue(method_exists($this->push, 'messages'));
        $this->assertInstanceOf(MessagesEndpoint::class, $this->push->messages());
    }

    /** @test */
    public function it_has_tokens_endpoint()
    {
        $this->assertTrue(method_exists($this->push, 'tokens'));
        $this->assertInstanceOf(TokensEndpoint::class, $this->push->tokens());
    }
}