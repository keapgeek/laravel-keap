<?php

namespace KeapGeek\Keap\Services;

class Order extends Service
{
    protected $uri = '/v1/orders';

    public function model()
    {
        return $this->client->get('/model');
    }
}
