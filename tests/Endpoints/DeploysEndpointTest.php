<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\DeploysEndpoint;
use Mirovit\IonicPlatformSDK\Response\Response;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\ListsResource;

class DeploysEndpointTest extends AbstractEndpointTest
{
    use DeletesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->endpoint .= '/deploy';
        $this->resource = '/deploys';
        $this->endpointClass = DeploysEndpoint::class;
    }

    /** @test */
    public function it_sets_a_channel()
    {
        $data = [
            'channel'   => 'fake-channel-id',
            'snapshot'  => 'fake-snapshot-id',
        ];

        $this->client
            ->post("{$this->endpoint}/deploys", ['body' => json_encode($data)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $deploys = new DeploysEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $deploys->set($data['channel'], $data['snapshot'])
        );
    }
}
