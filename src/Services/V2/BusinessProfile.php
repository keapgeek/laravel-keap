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
        $original = $this->info() ?? [];

        $data = array_merge($original, $data);

        return $this->patch('/', $data);
    }
}
