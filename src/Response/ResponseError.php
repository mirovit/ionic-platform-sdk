<?php

namespace Mirovit\IonicPlatformSDK\Response;


class ResponseError
{
    use Responder;

    /**
     * @var array
     */
    protected $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }
}