<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\MessagesEndpoint;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\ListsResource;

class MessagesEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->endpoint .= '/push';
        $this->resource = '/messages';
        $this->endpointClass = MessagesEndpoint::class;
    }
}
