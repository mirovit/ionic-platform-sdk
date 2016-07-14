<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractEndpointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $endpoint = 'http://fake.apiserver.com';

    /**
     * @var string
     */
    protected $resource;

    /**
     * @var string
     */
    protected $endpointClass;

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $client;

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $successResponse;

    protected $successMsg = [
        'meta'  => [
            'status'    => 200,
        ],
        'data'  => [],
    ];

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $errorResponse;

    protected $errorMsg = [
        'meta'  => [
            'status'    => 400,
        ],
        'error'  => [],
    ];

    public function setUp()
    {
        $this->client = $this->prophesize(\GuzzleHttp\Client::class);

        $this->successResponse = $this->getResponse($this->successMsg);
        $this->errorResponse = $this->getResponse($this->errorMsg);
    }

    /**
     * @param array $msg
     * @return \Prophecy\Prophecy\ObjectProphecy
     */
    protected function getResponse(array $msg)
    {
        $response = $this->prophesize(MessageInterface::class);

        $successMsg = $this->prophesize(StreamInterface::class);
        $successMsg
            ->getContents()
            ->willReturn(json_encode($msg));

        $response
            ->getBody()
            ->willReturn($successMsg->reveal());

        return $response;
    }
}