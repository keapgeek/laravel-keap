<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Task extends Service
{
    protected $uri = '/v1/tasks';


    public function model()
    {
        return $this->client->get('/model');
    }
}
