<?php

namespace Mirovit\IonicPlatformSDK\Endpoints;


class TokensEndpoint extends Endpoint
{
    public function all()
    {
    }

    public function get($token_id)
    {
    }

    public function save($token, $user_id)
    {
    }

    public function changeStatus($token_id, $status)
    {
    }

    public function validate($token_id)
    {
        return $this->changeStatus($token_id, true);
    }

    public function invalidate($token_id)
    {
        return $this->changeStatus($token_id, false);
    }

    public function destroy($token_id)
    {
    }
}