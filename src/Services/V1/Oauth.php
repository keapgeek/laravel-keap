<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class Oauth extends Service
{
    protected $uri = '/v1/oauth/connect/userinfo';

    public function user()
    {
        return $this->get('/');
    }
}
