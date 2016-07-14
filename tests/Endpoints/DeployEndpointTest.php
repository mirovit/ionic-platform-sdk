<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\ChannelsEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\DeployEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\DeploysEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\Endpoint;
use Mirovit\IonicPlatformSDK\Endpoints\SnapshotsEndpoint;

class DeployEndpointTest extends AbstractEndpointTest
{
    /**
     * @var DeployEndpoint
     */
    private $deploy;

    public function setUp()
    {
        parent::setUp();
        $this->deploy = new DeployEndpoint($this->client->reveal(), 'http://api.fakeserver.com');
    }

    /** @test */
    public function it_is_an_instance_of_endpoint()
    {
        $this->assertInstanceOf(Endpoint::class, $this->deploy);
    }

    /** @test */
    public function it_sets_correct_endpoint()
    {
        $this->assertSame('http://api.fakeserver.com/deploy', $this->deploy->getEndpoint());
    }

    /** @test */
    public function it_has_channels_endpoint()
    {
        $this->assertTrue(method_exists($this->deploy, 'channels'));
        $this->assertInstanceOf(ChannelsEndpoint::class, $this->deploy->channels());
    }

    /** @test */
    public function it_has_snapshots_endpoint()
    {
        $this->assertTrue(method_exists($this->deploy, 'snapshots'));
        $this->assertInstanceOf(SnapshotsEndpoint::class, $this->deploy->snapshots());
    }

    /** @test */
    public function it_has_deploys_endpoint()
    {
        $this->assertTrue(method_exists($this->deploy, 'deploys'));
        $this->assertInstanceOf(DeploysEndpoint::class, $this->deploy->deploys());
    }
}