<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

use Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException;

class UsersEndpoint extends Endpoint
{
    /**
     * Get all registered users.
     * 
     * @return array
     */
    public function all()
    {
        $response = $this->client->get($this->endpoint);

        return $this->response($response);
    }

    /**
     * Get a user by id.
     *
     * @param $uuid
     * @return array
     * @throws \Exception
     */
    public function get($uuid)
    {
        $response = $this->client->get($this->endpoint . "/{$uuid}");

        return $this->response($response);
    }

    /**
     * Get the current user.
     *
     * @return array
     */
    public function self()
    {
        $response = $this->client->get($this->endpoint . '/self', [
            'headers'   => [
                'Content-Type'  => 'application/json',
            ],
        ]);

        return $this->response($response);
    }

    /**
     * Creates a new user in an app.
     *
     * Required fields: app_id, email, password.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        if(!$this->hasKeys(['app_id', 'email', 'password'], $data)) {
            throw new MissingArgumentException('To create a user you need to pass at least the app_id, email and password');
        }
        
        $response = $this->client->post($this->endpoint, [
            'body' => json_encode($data),
            'headers'   => [
                'Content-Type'  => 'application/json',
            ],
        ]);

        return $this->response($response);
    }

    /**
     * Update a user.
     *
     * You should include the uuid in the array of data.
     *
     * @param array $data
     * @return array
     */
    public function update(array $data)
    {
        if(!$this->hasKeys(['uuid'], $data)) {
            throw new MissingArgumentException('You must pass the uuid when updating a user.');
        }

        $response = $this->client->patch(
            $this->endpoint . "/{$data['uuid']}",
            [
                'body' => json_encode($data),
                'headers'   => [
                    'Content-Type'  => 'application/json',
                ],
            ]
        );

        return $this->response($response);
    }

    /**
     * Delete a user.
     *
     * @param $uuid
     * @return null
     */
    public function destroy($uuid)
    {
        $response = $this->client->delete(
            $this->endpoint . "/{$uuid}",
            [
                'headers'   => [
                    'Content-Type'  => 'application/json',
                ],
            ]
        );

        return $this->response($response);
    }

    /**
     * Get the custom attributes for a user.
     *
     * @param $uuid
     * @return array
     */
    public function getCustom($uuid)
    {
        $response = $this->client->get(
            $this->endpoint . "/{$uuid}/custom",
            [
                'headers'   => [
                    'Content-Type'  => 'application/json',
                ],
            ]
        );

        return $this->response($response);
    }

    /**
     * Sets custom data attributes for a user.
     *
     * Note: It will override any existing data.
     *
     * @param array $data
     * @return array
     */
    public function setCustom(array $data)
    {
        if(!$this->hasKeys(['uuid'], $data)) {
            throw new MissingArgumentException('You must pass the uuid when updating user\'s custom fields.');
        }

        $uuid = $data['uuid'];
        unset($data['uuid']);

        $response = $this->client->put(
            $this->endpoint . "/{$uuid}/custom",
            [
                'body' => json_encode($data),
                'headers'   => [
                    'Content-Type'  => 'application/json',
                ],
            ]
        );

        return $this->response($response);
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
        $response = $this->client->post(
            $this->endpoint . "/{$uuid}/password-reset",
            [
                'headers'   => [
                    'Content-Type'  => 'application/json',
                ],
            ]
        );

        $response = $this->response($response);

        return is_array($response) && array_get($response, 'data.status') === 'sent';
    }
}