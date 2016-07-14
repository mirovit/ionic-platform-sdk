<?php

namespace Mirovit\IonicPlatformSDK\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Response\Response;

trait ListsResource
{
    /**
     * Get all from resource.
     *
     * @return Response
     */
    public function all()
    {
        $response = $this->client->get($this->getEndpoint());

        return $this->toResponse($response);
    }
}