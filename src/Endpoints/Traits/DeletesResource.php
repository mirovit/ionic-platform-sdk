<?php

namespace Mirovit\IonicPlatformSDK\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Response\Response;

trait DeletesResource
{
    /**
     * Delete a resource.
     *
     * @param $uuid
     * @return Response
     */
    public function delete($uuid)
    {
        $response = $this->client->delete("{$this->getEndpoint()}/{$uuid}");

        return null;
    }
}