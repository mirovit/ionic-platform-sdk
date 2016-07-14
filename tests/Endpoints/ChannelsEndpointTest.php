<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\ChannelsEndpoint;
use Mirovit\IonicPlatformSDK\Response\Response;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\ListsResource;

class ChannelsEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        DeletesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->endpoint .= '/deploy';
        $this->resource = '/channels';
        $this->endpointClass = ChannelsEndpoint::class;
    }

    /** @test */
    public function it_gets_a_channel_by_tag()
    {
        $tag = 'fake-tag';

        $this->client
            ->get("{$this->endpoint}{$this->resource}/{$tag}")
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $channels = new ChannelsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $channels->info($tag)
        );
    }
    
    /** @test */
    public function it_creates_a_channel()
    {
        $channel = [
            'label' => 'fake-label',
            'tag'   => 'fake-tag',
        ];

        $this->client
            ->post("{$this->endpoint}/channels", ['body' => json_encode($channel)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $channels = new ChannelsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $channels->create($channel)
        );
    }
    
    /**
     * @test
     * @expectedException \Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException
     */
    public function it_throws_an_error_when_missing_required_params_on_create()
    {
        $channels = new ChannelsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $channels->create([])
        );
    }
    
    /** @test */
    public function it_updates_a_channel()
    {
        $channel = [
            'uuid'      => 'fake-uuid',
            'label'     => 'fake-label',
        ];

        $this->client
            ->patch("{$this->endpoint}/channels/{$channel['uuid']}", ['body' => json_encode($channel)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $channels = new ChannelsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $channels->update($channel)
        );
    }

    /**
     * @test
     * @expectedException \Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException
     */
    public function it_throws_an_exception_when_missing_required_parameters_in_update()
    {
        $channels = new ChannelsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $channels->update([])
        );
    }
}
