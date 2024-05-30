<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Setting extends Service
{
    protected $uri = '/v1/setting';


    public function status()
    {
        $value = $this->client->get('/application/enabled')['value'];
        return $value === 'yes';
    }

    public function config()
    {
        return $this->client->get('/application/configuration');
    }
}
