<?php

namespace Mirovit\IonicPlatformSDK\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Response\Response;

trait ListsResource
{
    /**
     * Get all from resource.
     *
     * @param array $query query parameters of list request
     * @return Response
     */
    public function all(array $query = [])
    {
        $response = $this->client->get($this->getEndpoint(), [
            'query' => $query
        ]);

        return $this->toResponse($response);
    }
}