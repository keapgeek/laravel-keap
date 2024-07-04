<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class BusinessProfile extends Service
{
    protected $uri = '/v2/businessProfile';

    public function info()
    {
        return $this->get('/');
    }

    public function update(array $data)
    {
        return $this->patch('/', $data);
    }
}
