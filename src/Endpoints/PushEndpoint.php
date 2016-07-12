<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;

class PushEndpoint extends Endpoint
{
    /**
     * @return NotificationsEndpoint
     */
    public function notifications()
    {
        return $this->endpoint(NotificationsEndpoint::class);
    }

    /**
     * @return MessagesEndpoint
     */
    public function messages()
    {
        return $this->endpoint(MessagesEndpoint::class);
    }

    /**
     * @return TokensEndpoint
     */
    public function tokens()
    {
        return $this->endpoint(TokensEndpoint::class);
    }
}