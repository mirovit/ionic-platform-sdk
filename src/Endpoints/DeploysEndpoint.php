<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\ListsResource;
use Mirovit\IonicPlatformSDK\Response\Response;

class DeploysEndpoint extends Endpoint
{
    use DeletesResource,
        ListsResource;

    /**
     * @param $channel
     * @param $snapshot
     * @return Response
     */
    public function set($channel, $snapshot)
    {
        $data = compact('channel', 'snapshot');

        $response = $this->client->post($this->getEndpoint(), [
            'body' => json_encode($data),
        ]);

        return $this->toResponse($response);
    }
}