<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\Traits\CreatesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\UpdatesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\ListsResource;
use Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException;
use Mirovit\IonicPlatformSDK\Response\Response;

class UsersEndpoint extends Endpoint
{
    use CreatesResource,
        UpdatesResource,
        FetchesResource,
        DeletesResource,
        ListsResource;

    /**
     * Get the current user.
     *
     * @return Response
     */
    public function self()
    {
        $response = $this->client->get("{$this->getEndpoint()}/self");

        return $this->toResponse($response);
    }

    /**
     * Get the custom attributes for a user.
     *
     * @param $uuid
     * @return Response
     */
    public function getCustom($uuid)
    {
        $response = $this->client->get("{$this->getEndpoint()}/{$uuid}/custom");

        return $this->toResponse($response);
    }

    /**
     * Sets custom data attributes for a user.
     *
     * Note: It will override any existing data.
     *
     * @param array $data
     * @return Response
     */
    public function setCustom(array $data)
    {
        if(!$this->validation()->hasKeys(['uuid'], $data)) {
            throw new MissingArgumentException('You must pass the uuid when updating user\'s custom fields.');
        }

        $uuid = $data['uuid'];
        unset($data['uuid']);

        $response = $this->client->put(
            "{$this->getEndpoint()}/{$uuid}/custom",
            [
                'body' => json_encode($data),
            ]
        );

        return $this->toResponse($response);
    }

    /**
     * Reset the password of a user.
     *
     * Returns bool whether it was successful.
     *
     * @param $uuid
     * @return bool
     */
    public function passwordReset($uuid)
    {
        $response = $this->client->post("{$this->getEndpoint()}/{$uuid}/password-reset");

        $response = $this->toResponse($response);

        return $response->isSuccessful() && $response->data()->get('status') === 'sent';
    }


    /**
     * Required fields: app_id, email, password.
     *
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateCreate(array $data)
    {
        if(!$this->validation()->hasKeys(['app_id', 'email', 'password'], $data)) {
            throw new MissingArgumentException('To create a user you need to pass at least the app_id, email and password');
        }
    }

    /**
     * Required fields: uuid.
     *
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateUpdate(array $data)
    {
        if(!$this->validation()->hasKeys(['uuid'], $data)) {
            throw new MissingArgumentException('You must pass the uuid when updating a user.');
        }
    }
}