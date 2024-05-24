<?php

namespace KeapGeek\Keap\Services;

class Company extends Service
{
    protected $uri = '/v1/companies';

    public function list()
    {
        return $this->client->get();
    }


}
