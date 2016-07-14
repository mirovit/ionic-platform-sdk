<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

use Mirovit\IonicPlatformSDK\Endpoints\Traits\UpdatesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\FetchesResource;
use Mirovit\IonicPlatformSDK\Endpoints\Traits\ListsResource;
use Mirovit\IonicPlatformSDK\Exceptions\MissingArgumentException;

class SnapshotsEndpoint extends Endpoint
{
    use UpdatesResource,
        FetchesResource,
        ListsResource;

    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateUpdate(array $data)
    {
        if(!$this->validation()->hasKeys(['uuid'], $data)) {
            throw new MissingArgumentException('You need to give the snapshot uuid.');
        }
    }
}