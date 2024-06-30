<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Company extends Service
{
    protected $uri = '/v1/companies';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['companies'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);

        return (int) $list['count'];
    }

    public function find($company_id, $options = [])
    {
        $data = $options ? ['optional_properties' => implode(',', $options)] : [];

        return $this->get("/$company_id", $data);
    }

    public function create(array $data)
    {
        if (! array_key_exists('company_name', $data) || is_null($data['company_name'])) {
            throw new ValidationException('Required: company_name');
        }
        if (! array_key_exists('opt_in_reason', $data) || is_null($data['opt_in_reason'])) {
            $data['opt_in_reason'] = config('keap.opt_in_reason');
        }

        return $this->post('/', $data);
    }

    public function update(int $company_id, array $data)
    {
        if (! array_key_exists('company_name', $data) || is_null($data['company_name'])) {
            throw new ValidationException('Required: company_name');
        }
        if (! array_key_exists('opt_in_reason', $data) || is_null($data['opt_in_reason'])) {
            $data['opt_in_reason'] = config('keap.opt_in_reason');
        }

        return $this->patch("/$company_id", $data);
    }

    public function model()
    {
        return $this->get('/model');
    }
}
