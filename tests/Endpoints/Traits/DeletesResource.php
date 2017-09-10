<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Response\Response;

trait DeletesResource
{
    /** @test */
    public function it_deletes_a_resource()
    {
        $uuid = 'fake-uuid';

        $this->client
            ->delete("{$this->endpoint}{$this->resource}/{$uuid}")
            ->shouldBeCalled()
            ->willReturn(null);

        $resource = new $this->endpointClass(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertNull(
            $resource->delete($uuid)
        );
    }
}