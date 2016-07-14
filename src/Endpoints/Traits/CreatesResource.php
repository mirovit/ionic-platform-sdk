<?php

namespace Mirovit\IonicPlatformSDK\Endpoints\Traits;

use Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException;
use Mirovit\IonicPlatformSDK\Response\Response;

trait CreatesResource
{
    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    abstract protected function validateCreate(array $data);

    /**
     * Creates a new resource.
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data)
    {
        $this->validateCreate($data);

        $response = $this->client->post($this->getEndpoint(), [
            'body' => json_encode($data),
        ]);

        return $this->toResponse($response);
    }
}