<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;


use Mirovit\IonicPlatformSDK\Endpoints\SnapshotsEndpoint;
use Mirovit\IonicPlatformSDK\Response\Response;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\ListsResource;

class SnapshotsEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->endpoint .= '/deploy';
        $this->resource = '/snapshots';
        $this->endpointClass = SnapshotsEndpoint::class;
    }

    /** @test */
    public function it_updates_a_snapshot()
    {
        $snapshot = [
            'uuid'      => 'fake-uuid',
        ];

        $this->client
            ->patch("{$this->endpoint}/snapshots/{$snapshot['uuid']}", ['body' => json_encode($snapshot)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $snapshots = new SnapshotsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $snapshots->update($snapshot)
        );
    }

    /**
     * @test
     * @expectedException \Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException
     */
    public function it_throws_an_exception_when_missing_required_argument_in_update()
    {
       $snapshots = new SnapshotsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $snapshots->update([])
        );
    }
}
