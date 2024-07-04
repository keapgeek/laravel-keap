<?php

namespace KeapGeek\Keap\Services;

class User extends Service
{
    protected $uri = '/v1/users';

    public function list()
    {
        return $this->get('/');
    }

    public function emailSignature(int $userId)
    {
        return $this->get("/$userId/signature");
    }

    public function create(string $email, string $given_name, bool $admin = false, bool $partner = false)
    {
        return $this->post('/', [
            'email' => $email,
            'given_name' => $given_name,
            'admin' => $admin,
            'partner' => $partner,
        ]);
    }
}
