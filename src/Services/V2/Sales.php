<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Sales extends Service
{
    protected $uri = '/v2/sales/';

    public function setDefault(int $merchant_id)
    {
        return $this->post("/merchants/$merchant_id:setDefault", []);
    }
}
