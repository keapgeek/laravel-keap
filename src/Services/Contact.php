<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\KeapException;

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
        if (! array_key_exists('email_addresses', $data) && ! array_key_exists('phone_numbers', $data)) {
            throw new KeapException('Missing Email addresses and/or phone numbers');
        }

        $data['opt_in_reason'] = config('keap.opt_in_reason');

        return $this->client->post('/', $data);

    }

    public function createOrUpdate(array $data, $duplicate_option = 'Email')
    {
        if (! array_key_exists('email_addresses', $data) && ! array_key_exists('phone_numbers', $data)) {
            throw new KeapException('Missing Email addresses and/or phone numbers');
        }

        $data['duplicate_option'] = $duplicate_option;
        $data['opt_in_reason'] = config('keap.opt_in_reason');

        return $this->client->put('/', $data);

    }
}
