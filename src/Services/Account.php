<?php

namespace KeapGeek\Keap\Services;

class Account extends Service
{
    protected $uri = '/v1/account/profile';

    public function info()
    {
        return $this->get();
    }

    public function update(array $data)
    {
        $original = $this->info() ?? [];

        $data = array_merge($original, $data);

        return $this->put('/', $data);
    }
}
