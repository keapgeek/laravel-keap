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

    public function create(string $email, string $given_name, bool $admin = false, bool $partner = false)
    {
        return $this->client->post("/", [
            'email' => $email,
            'given_name' => $given_name,
            'admin' => $admin,
            'partner' => $partner,
        ]);
    }
}
