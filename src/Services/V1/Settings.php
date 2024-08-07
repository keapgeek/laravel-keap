<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class Settings extends Service
{
    protected $uri = '/v1/setting';

    public function status()
    {
        $value = $this->get('/application/enabled')['value'];

        return $value === 'yes';
    }

    public function config()
    {
        return $this->get('/application/configuration');
    }
}
