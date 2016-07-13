<?php

use Mirovit\IonicPlatformSDK\Response\Response;

class ResponseTest extends PHPUnit_Framework_TestCase
{
    protected $successResponse = [];
    protected $errorResponse = [];

    public function setUp()
    {
        $this->successResponse = [
            'meta'  => [
                'status'        => 200,
                'version'       => '2.0.0',
                'request_id'    => 'd5ccbe45-a54e-4d19-9b58-a96c7747369f',
            ],
            'data'  => [],
        ];

        $this->errorResponse = [
            'meta'  => [
                'status'        => 400,
                'version'       => '2.0.0',
                'request_id'    => 'd5ccbe45-a54e-4d19-9b58-a96c7747369f',
            ],
            'error'  => [
                'message'   => 'Authorization header is missing.',
                'link'      => null,
                'type'      => 'Unauthorized',
            ],
        ];
    }

    /** @test */
    public function it_fills_a_success_response_correctly()
    {
        $response = new Response($this->successResponse);

        $this->assertTrue($response->isSuccessful());
        $this->assertSame($this->successResponse['meta']['status'], $response->meta()->get('status'));
        $this->assertSame($this->successResponse['meta'], $response->meta()->toArray());
    }
    
    /** @test */
    public function it_fills_an_error_response_correctly()
    {
        $response = new Response($this->errorResponse);

        $this->assertFalse($response->isSuccessful());
        $this->assertSame($this->errorResponse['error']['type'], $response->error()->get('type'));
    }
    
    /** @test */
    public function it_returns_default_value_when_one_does_not_exist()
    {
        $response = new Response($this->successResponse);

        $this->assertNull($response->get('blah'));
    }
    
    /** @test */
    public function it_does_correct_check_for_key_existence()
    {
        $response = new Response($this->successResponse);

        $this->assertTrue($response->has('meta'));
        $this->assertFalse($response->has('blah'));
    }

    /** @test */
    public function it_uses_the_magic_get()
    {
        $response = new Response($this->successResponse);

        $this->assertSame($this->successResponse['meta'], $response->meta);
    }

    /** @test */
    public function it_has_a_meta_response_object()
    {
        $response = new Response($this->successResponse);

        $this->assertInstanceOf(\Mirovit\IonicPlatformSDK\Response\ResponseMeta::class, $response->meta());
    }

    /** @test */
    public function it_has_a_data_response_object()
    {
        $response = new Response($this->successResponse);

        $this->assertInstanceOf(\Mirovit\IonicPlatformSDK\Response\ResponseData::class, $response->data());
    }

    /** @test */
    public function it_has_an_error_response_object()
    {
        $response = new Response($this->successResponse);

        $this->assertInstanceOf(\Mirovit\IonicPlatformSDK\Response\ResponseError::class, $response->error());
    }
}
