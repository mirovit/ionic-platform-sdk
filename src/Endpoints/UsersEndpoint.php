<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

use Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException;
use Mirovit\IonicPlatformSDK\Response\Response;

class UsersEndpoint extends Endpoint
{
    /**
     * Get all registered users.
     * 
     * @return Response
     */
    public function all()
    {
        $response = $this->client->get($this->getEndpoint());

        return $this->toResponse($response);
    }

    /**
     * Get a user by id.
     *
     * @param $uuid
     * @return Response
     * @throws \Exception
     */
    public function get($uuid)
    {
        $response = $this->client->get("{$this->getEndpoint()}/{$uuid}");

        return $this->toResponse($response);
    }

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
     * Creates a new user in an app.
     *
     * Required fields: app_id, email, password.
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data)
    {
        if(!$this->validation()->hasKeys(['app_id', 'email', 'password'], $data)) {
            throw new MissingArgumentException('To create a user you need to pass at least the app_id, email and password');
        }
        
        $response = $this->client->post($this->getEndpoint(), [
            'body' => json_encode($data),
        ]);

        return $this->toResponse($response);
    }

    /**
     * Update a user.
     *
     * You should include the uuid in the array of data.
     *
     * @param array $data
     * @return Response
     */
    public function update(array $data)
    {
        if(!$this->validation()->hasKeys(['uuid'], $data)) {
            throw new MissingArgumentException('You must pass the uuid when updating a user.');
        }

        $response = $this->client->patch(
            $this->getEndpoint() . "/{$data['uuid']}",
            [
                'body' => json_encode($data),
            ]
        );

        return $this->toResponse($response);
    }

    /**
     * Delete a user.
     *
     * @param $uuid
     * @return Response
     */
    public function destroy($uuid)
    {
        $response = $this->client->delete("{$this->getEndpoint()}/{$uuid}");

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
}