<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Affiliate extends Service
{
    protected $uri = '/v1/affiliates';


    public function model()
    {
        return $this->client->get('/model');
    }
}
