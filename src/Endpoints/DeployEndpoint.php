<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

class DeployEndpoint extends Endpoint
{
    /**
     * @return ChannelsEndpoint
     */
    public function channels()
    {
        return $this->endpoint(ChannelsEndpoint::class);
    }

    /**
     * @return SnapshotsEndpoint
     */
    public function snapshots()
    {
        return $this->endpoint(SnapshotsEndpoint::class);
    }

    /**
     * @return DeploysEndpoint
     */
    public function deploys()
    {
        return $this->endpoint(DeploysEndpoint::class);
    }
}