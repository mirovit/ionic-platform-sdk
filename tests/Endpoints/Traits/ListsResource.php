<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Response\Response;

trait ListsResource
{
    /** @test */
    public function it_lists_a_resource_list_with_empty_query()
    {
        $query = ['query' => []];

        $this->client
            ->get("{$this->endpoint}{$this->resource}", $query)
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $endpoint = new $this->endpointClass(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $endpoint->all()
        );
    }
}