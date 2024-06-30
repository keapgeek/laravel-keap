<?php

namespace KeapGeek\Keap\Services;

class Oauth extends Service
{
    protected $uri = '/v1/oauth/connect/userinfo';

    public function user()
    {
        return $this->get('/');
    }
}
