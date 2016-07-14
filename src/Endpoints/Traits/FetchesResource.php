<?php

namespace Mirovit\IonicPlatformSDK\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Response\Response;

trait FetchesResource
{
    /**
     * Get a resource by id.
     *
     * @param $uuid
     * @return Response
     */
    public function get($uuid)
    {
        $response = $this->client->get("{$this->getEndpoint()}/{$uuid}");

        return $this->toResponse($response);
    }
}