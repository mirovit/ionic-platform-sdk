<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Response\Response;

trait FetchesResource
{
    /** @test */
    public function it_gets_a_resource()
    {
        $uuid = 'fake-uuid';

        $this->client
            ->get("{$this->endpoint}{$this->resource}/{$uuid}")
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $resource = new $this->endpointClass(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $resource->get($uuid)
        );
    }
}