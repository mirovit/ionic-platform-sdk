<?php

namespace Mirovit\IonicPlatformSDK\Response;

abstract class Responder
{
    /**
     * @var array
     */
    protected $response = [];

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->response);
    }

    public function get($key, $default = null)
    {
        if($this->has($key)){
            return $this->response[$key];
        }

        return $default;
    }

    public function toArray()
    {
        return $this->response;
    }

    public function __get($key)
    {
        return $this->get($key);
    }
}