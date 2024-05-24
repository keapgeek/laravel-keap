<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Note extends Service
{
    protected $uri = '/v1/notes';


    public function model()
    {
        return $this->client->get('/model');
    }
}
