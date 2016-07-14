<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\ListsResource;
use Mirovit\IonicPlatformSDK\Response\Response;

class TokensEndpoint extends Endpoint
{
    use DeletesResource,
        FetchesResource,
        ListsResource;

    /**
     * @param $token
     * @param $userId
     * @return Response
     */
    public function save($token, $userId)
    {
        $data = [
            'token'     => $token,
            'user_id'   => $userId,
        ];

        $response = $this->client->post($this->getEndpoint(), [
            'body' => json_encode($data),
        ]);

        return $this->toResponse($response);
    }

    /**
     * @param $tokenId
     * @param $status
     * @return Response
     */
    public function changeStatus($tokenId, $status)
    {
        $data = [
            'token_id'  => $tokenId,
            'valid'     => $status,
        ];

        $response = $this->client->patch(
            "{$this->getEndpoint()}/{$tokenId}",
            [
                'body' => json_encode($data),
            ]
        );

        return $this->toResponse($response);
    }

    /**
     * @param $tokenId
     * @return Response
     * @codeCoverageIgnore
     */
    public function validate($tokenId)
    {
        return $this->changeStatus($tokenId, true);
    }

    /**
     * @param $tokenId
     * @return Response
     * @codeCoverageIgnore
     */
    public function invalidate($tokenId)
    {
        return $this->changeStatus($tokenId, false);
    }
}