<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Affiliate extends Service
{
    protected $uri = '/v2/affiliates';


    public function find(int $affiliate_id)
    {
        return $this->get("/$affiliate_id");
    }

    public function create(array $data)
    {
        return $this->post('/', $data);
    }
    public function update(int $affiliate_id, array $data)
    {
        return $this->patch("/$affiliate_id", $data);
    }
    public function updateProgram(int $program_id, array $data)
    {
        return $this->patch("/commissionPrograms/$program_id", $data);
    }
}
