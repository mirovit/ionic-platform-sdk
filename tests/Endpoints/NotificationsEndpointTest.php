<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;


use Mirovit\IonicPlatformSDK\Endpoints\NotificationsEndpoint;
use Mirovit\IonicPlatformSDK\Response\Response;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\ListsResource;

class NotificationsEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->endpoint .= '/push';
        $this->resource = '/notifications';
        $this->endpointClass = NotificationsEndpoint::class;
    }
    
    /** @test */
    public function it_gets_messages_for_notification()
    {
        $uuid = 'fake-uuid';

        $this->client
            ->get("{$this->endpoint}/notifications/{$uuid}/messages")
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $notifications = new NotificationsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $notifications->messages($uuid)
        );
    }
    
    /** @test */
    public function it_creates_a_notification()
    {
        $notification = [];

        $this->client
            ->post("{$this->endpoint}/notifications", [
                'body'  => json_encode($notification)
            ])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $notifications = new NotificationsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $notifications->create($notification)
        );
    }
}
