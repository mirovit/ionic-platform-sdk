<?php

namespace Mirovit\IonicPlatformSDK\Response;

class Response
{
    use Responder;

    /**
     * @var array
     */
    protected $response = [];

    /**
     * @var ResponseMeta
     */
    protected $meta;

    /**
     * @var ResponseData
     */
    protected $data;

    /**
     * @var ResponseError
     */
    protected $error;

    public function __construct(array $endpointResponse)
    {
        $this->response = $endpointResponse;
        $this->fill();
    }

    /**
     * @return ResponseMeta
     */
    public function meta()
    {
        return $this->meta;
    }

    /**
     * @return ResponseData
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * @return ResponseError
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->meta->isSuccessful();
    }

    /**
     * Create the corresponding classes
     */
    private function fill()
    {
        $this->meta = new ResponseMeta($this->get('meta'));
        $this->data = new ResponseData($this->get('data', []));
        $this->error = new ResponseError($this->get('error', []));
    }
}