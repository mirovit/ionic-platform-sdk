<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\TokensEndpoint;
use Mirovit\IonicPlatformSDK\Response\Response;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\ListsResource;

class TokensEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        DeletesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->endpoint .= '/push';
        $this->resource = '/tokens';
        $this->endpointClass = TokensEndpoint::class;
    }
    
    /** @test */
    public function it_changes_token_status()
    {
        $status = [
            'token_id'  => 'fake-uuid',
            'valid'     => true,
        ];

        $this->client
            ->patch("{$this->endpoint}/tokens/{$status['token_id']}", ['body' => json_encode($status)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $tokens = new TokensEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $tokens->changeStatus($status['token_id'], $status['valid'])
        );
    }
    
    /** @test */
    public function it_saves_a_token()
    {
        $data = [
            'token'     => 'fake-token-string',
            'user_id'   => 'fake-uuid',
        ];

        $this->client
            ->post("{$this->endpoint}/tokens", ['body' => json_encode($data)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $tokens = new TokensEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $tokens->save($data['token'], $data['user_id'])
        );
    }
}
