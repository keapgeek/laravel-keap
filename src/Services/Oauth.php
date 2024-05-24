<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Oauth extends Service
{
    protected $uri = '/v1/oauth/connect/userinfo';


    public function user()
    {
        return $this->client->get('/');
    }
}
