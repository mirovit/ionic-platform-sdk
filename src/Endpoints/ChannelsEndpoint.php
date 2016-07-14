<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;


use Mirovit\IonicPlatformSDK\Endpoints\Traits\CreatesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\DeletesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\ListsResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\UpdatesResource;
use Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException;
use Mirovit\IonicPlatformSDK\Response\Response;

class ChannelsEndpoint extends Endpoint
{
    use CreatesResource,
        UpdatesResource,
        FetchesResource,
        DeletesResource,
        ListsResource;

    /**
     * @param $tag
     * @return Response
     */
    public function info($tag)
    {
        return $this->get($tag);
    }

    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateCreate(array $data)
    {
        if(!$this->validation()->hasKeys(['label'], $data)) {
            throw new MissingArgumentException('You need to provide a label for the new channel.');
        }
    }

    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateUpdate(array $data)
    {
        if(!$this->validation()->hasKeys(['uuid'], $data)) {
            throw new MissingArgumentException('You need to provide the channell uuid for update.');
        }
    }
}