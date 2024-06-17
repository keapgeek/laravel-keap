<?php

namespace KeapGeek\Keap\Services;

class Merchant extends Service
{
    protected $uri = '/v1/merchants';

    public function list()
    {
        return $this->client->get('/')['merchant_accounts'];
    }

    public function default()
    {
        return $this->client->get('/')['default_merchant_account'];
    }
}
