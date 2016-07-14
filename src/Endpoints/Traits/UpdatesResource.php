<?php

namespace Mirovit\IonicPlatformSDK\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException;
use Mirovit\IonicPlatformSDK\Response\Response;

trait UpdatesResource
{
    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    abstract protected function validateUpdate(array $data);

    /**
     * Update a resource.
     *
     * @param array $data
     * @return Response
     */
    public function update(array $data)
    {
        $this->validateUpdate($data);

        $response = $this->client->patch(
            "{$this->getEndpoint()}/{$data['uuid']}",
            [
                'body' => json_encode($data),
            ]
        );

        return $this->toResponse($response);
    }
}