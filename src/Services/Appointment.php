<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Appointment extends Service
{
    protected $uri = '/v1/appointments';


    public function model()
    {
        return $this->client->get('/model');
    }
}
