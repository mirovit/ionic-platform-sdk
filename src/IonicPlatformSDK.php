<?php

namespace Mirovit\IonicPlatformSDK;

use GuzzleHttp\Client;
use Mirovit\IonicPlatformSDK\Endpoints\Endpoint;
use Mirovit\IonicPlatformSDK\Endpoints\DeployEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\PushEndpoint;
use Mirovit\IonicPlatformSDK\Endpoints\UsersEndpoint;

class IonicPlatformSDK extends Endpoint
{
    /**
     * @param string $token
     * @param string $endpoint
     */
    public function __construct($token = null, $endpoint = 'https://api.ionic.io')
    {
        $token = $token === null ? getenv('IONIC_TOKEN') : $token;

        $this->client = new Client([
            'headers'   => [
                'Authorization' => "Bearer {$token}",
                'Content-Type'  => 'application/json',
            ],
        ]);

        parent::__construct($this->client, $endpoint);

        $this->setEndpoint($endpoint);
    }

    /**
     * @return UsersEndpoint
     */
    public function users()
    {
        return $this->endpoint(UsersEndpoint::class);
    }

    /**
     * @return PushEndpoint
     */
    public function push()
    {
        return $this->endpoint(PushEndpoint::class);
    }

    /**
     * @return DeployEndpoint
     */
    public function deploy()
    {
        return $this->endpoint(DeployEndpoint::class);
    }
}