<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Setting extends Service
{
    protected $uri = '/v1/setting';


    public function status()
    {
        return $this->client->get('/application/enabled');
    }

    public function config()
    {
        return $this->client->get('/application/configuration');
    }
}
