<?php

namespace KeapGeek\Keap\Services;

class Account extends Service
{
    protected $uri = '/v1/account/profile';

    public function info()
    {
        return $this->client->get();
    }

    public function update(array $data)
    {
        $original = $this->info();

        $data = array_merge($original, $data);

        return $this->client->put('/', $data);
    }

}
