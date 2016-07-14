<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Response\Response;

class DeploysEndpoint extends Endpoint
{
    use DeletesResource;

    /**
     * Get all from resource.
     *
     * @param string $channelUuid
     * @return Response
     */
    public function all($channelUuid)
    {
        $response = $this->client->get($this->getEndpoint(), [
            'form_params'   => [
                'channel'   => $channelUuid
            ]
        ]);

        return $this->toResponse($response);
    }

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