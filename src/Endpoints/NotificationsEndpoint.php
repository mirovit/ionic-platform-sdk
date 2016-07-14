<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\Traits\CreatesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\ListsResource;
use Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException;
use Mirovit\IonicPlatformSDK\Response\Response;

class NotificationsEndpoint extends Endpoint
{
    use CreatesResource,
        FetchesResource,
        ListsResource;

    /**
     * @param $uuid
     * @return Response
     */
    public function messages($uuid)
    {
        $response = $this->client->get("{$this->getEndpoint()}/{$uuid}/messages");

        return $this->toResponse($response);
    }

    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateCreate(array $data)
    {
    }
}