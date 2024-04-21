<?php

namespace Azzarip\Keap\Services;
use Azzarip\Keap\Exceptions\KeapException;

class Contact extends Service
{
    protected $uri = '/v1/contacts';

    public function list()
    {
        return $this->client->get();
    }

    public function get(int $id)
    {
        return $this->client->get($id);
    }

    public function create(array $data)
    {
        if (!array_key_exists('email_addresses', $data) && ! array_key_exists('phone_numbers', $data)) {
            throw new KeapException('Missing Email addresses and/or phone numbers');
        }

        return $this->client->post('/', $data);

    }
}
