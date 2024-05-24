<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Company extends Service
{
    protected $uri = '/v1/companies';

    public function list()
    {
        return $this->client->get();
    }

    public function create(array $data)
    {
        if (!array_key_exists('company_name', $data) || is_null($data['company_name'])) {
            throw new ValidationException('Required: company_name');
        }
        if (!array_key_exists('opt_in_reason', $data) || is_null($data['opt_in_reason'])) {
            $data['opt_in_reason'] = config('keap.opt_in_reason');
        }
        return $this->client->post('/', $data);
    }

    public function model()
    {
        return $this->client->get('/model');
    }
}
