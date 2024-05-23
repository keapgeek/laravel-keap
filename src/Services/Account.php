<?php

namespace Azzarip\Keap\Services;

class Account extends Service
{
    protected $uri = '/v1/account/profile';

    public function retrieve()
    {
        return $this->client->get();
    }

    public function update(array $data)
    {
        return $this->client->put('/', $data);
    }

}
