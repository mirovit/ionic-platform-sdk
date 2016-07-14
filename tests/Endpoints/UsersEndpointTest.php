<?php

namespace Mirovit\IonicPlatformSDK\Tests\Endpoints;

use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Tests\Endpoints\Traits\ListsResource;
use Mirovit\IonicPlatformSDK\Endpoints\UsersEndpoint;
use Mirovit\IonicPlatformSDK\Response\Response;

class UsersEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        DeletesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->resource = '/users';
        $this->endpointClass = UsersEndpoint::class;
    }

    /** @test */
    public function it_gets_user_self()
    {
        $this->client
            ->get("{$this->endpoint}/users/self")
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $users->self()
        );
    }

    /** @test */
    public function it_creates_an_user_when_correct_data_is_passed()
    {
        $user = [
            'app_id'    => 'fake-app-id',
            'email'     => 'john@doe.com',
            'password'  => 'password',
        ];

        $this->client
            ->post("{$this->endpoint}/users", ['body' => json_encode($user)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $users->create($user)
        );
    }

    /**
     * @test
     * @expectedException \Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException
     */
    public function it_throws_an_exception_when_missing_required_parameters_in_create()
    {
        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $users->create([])
        );
    }

    /** @test */
    public function it_updates_an_user_when_correct_data_is_passed()
    {
        $user = [
            'uuid'      => 'fake-uuid',
            'email'     => 'john@doe.com',
            'password'  => 'password',
        ];

        $this->client
            ->patch("{$this->endpoint}/users/{$user['uuid']}", ['body' => json_encode($user)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $users->update($user)
        );
    }

    /**
     * @test
     * @expectedException \Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException
     */
    public function it_throws_an_exception_when_missing_required_parameters_in_update()
    {
        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $users->update([])
        );
    }

    /** @test */
    public function it_gets_user_custom_data()
    {
        $uuid = 'fake-uuid';

        $this->client
            ->get("{$this->endpoint}/users/{$uuid}/custom")
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $users->getCustom($uuid)
        );
    }

    /** @test */
    public function it_updates_user_custom_data()
    {
        $uuid = 'fake-uuid';
        $custom = [
            'foo'       => 'bar',
        ];

        $this->client
            ->put("{$this->endpoint}/users/{$uuid}/custom", ['body' => json_encode($custom)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $custom['uuid'] = $uuid;

        $this->assertInstanceOf(
            Response::class,
            $users->setCustom($custom)
        );
    }

    /**
     * @test
     * @expectedException \Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException
     */
    public function it_throws_an_exception_when_missing_required_parameters_in_custom()
    {
        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $users->setCustom([])
        );
    }

    /** @test */
    public function it_sends_a_password_reset()
    {
        $uuid = 'fake-uuid';

        $response = $this->getResponse([
            'meta'  => [
                'status'    => 200
            ],
            'data'  => [
                'status'    => 'sent'
            ],
        ]);

        $this->client
            ->post("{$this->endpoint}/users/{$uuid}/password-reset")
            ->shouldBeCalled()
            ->willReturn($response->reveal());

        $users = new UsersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertTrue(
            $users->passwordReset($uuid)
        );
    }
}