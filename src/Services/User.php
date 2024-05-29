<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class User extends Service
{
    protected $uri = '/v1/users';

    public function list()
    {
        return $this->client->get('/');
    }

    public function emailSignature(int $userId)
    {
        return $this->client->get("/$userId/signature");
    }

    public function create(array $data)
    {
        return $this->client->post("/", $data);
    }
}
