<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Company extends Service
{
    protected $uri = '/v2/companies';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);
        return $list['companies'];
    }

    public function delete(int $company_id)
    {
             return $this->del("/$company_id");
    }

    public function update(int $company_id, array $data)
    {
        return $this->patch("/$company_id", $data);
    }

    public function create(array $data)
    {
        return $this->post('/', $data);
    }

    public function find(int $company_id, $options = [])
    {
        $data = $options ? ['optional_properties' => implode(',', $options)] : [];

        return $this->get("/$company_id", $data);
    }
}
